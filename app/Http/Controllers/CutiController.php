<?php

namespace App\Http\Controllers;

use App\Http\Requests\CutiRequest;
use App\Models\{Cuti, Kategori, Acc_mandiv, Acc_hrd};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Exports\CutiExport;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;

class CutiController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $cutis = Cuti::where('user_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);

        return view('cuti.index', compact('cutis'));
    }
    public function admin()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 1) {
            $cutis = Cuti::where('acc_mandiv_id', 3)->latest()->simplePaginate(20);
        } else {
            $cutis = Cuti::whereHas('user', function ($query) {
                $divisi_id = Auth::user()->divisi_id;
                $query->whereDivisiId($divisi_id);
            })->latest()->simplePaginate(20);
        }
        return view('cuti.admin', compact('cutis', 'role_id'));
    }
    public function show(Cuti $cuti)
    {
        return view('cuti.show', compact('cuti'));
    }

    public function create()
    {
        $user = Auth::user();
        $kategoris = Kategori::get();
        $cutis = Cuti::where([
            ['user_id', '=', $user->id],
            ['kategori_id', '=', 1],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_mulai', '=', now()->year)->get();
        $totalCuti = 0;
        foreach ($cutis as $cuti) {
            $datetime1 = new DateTime($cuti->tgl_mulai);
            $datetime2 = new DateTime($cuti->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;
            $totalCuti += $days;
        }
        $sisaCutis = 12 - $totalCuti;

        return view('cuti.create', compact('kategoris', 'sisaCutis'));
    }
    public function store(CutiRequest $request)
    {   $role_id = Auth::user()->role_id;
        $divisi_id = Auth::user()->divisi_id;
        $role_id = Auth::user()->role_id;
        $attr = $request->all();

        if ($request->kategori != 1 && Auth::user()->gender == "Pria") {
            session()->flash('error', 'Permintaan anda gagal diajukan, Hanya mendapat Cuti Tahunan');
            return redirect(route('cuti.create'));
        }

        //check cuti tahunan tidak melebihi sisa cuti
        if ($request->kategori == 1) {
            $datetime1 = new DateTime($request->tgl_mulai);
            $datetime2 = new DateTime($request->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;

            if ($days > $request->sisa_cuti) {
                session()->flash('error', 'Permintaan anda gagal diajukan, Melebihi kuota cuti tahunan');
                return redirect(route('cuti.create'));
            }
        }

        //validasi lampiran
        $request->validate([
            'lampiran' => 'image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if ($request->kategori == 2) {
            $request->validate([
                'tgl_selesai' => 'date_equals:tgl_mulai'
            ]);
        }
        if (request()->file('lampiran')) {
            $lampiran = request()->file('lampiran')->store("images/cuti");
        } else {
            $lampiran = null;
        }

        $attr['slug'] = Str::random(9);
        $attr['kategori_id'] = request('kategori');
        $attr['lampiran'] = $lampiran;

        if ($divisi_id == 5) {
            $attr['acc_mandiv_id'] = 3;
            $attr['acc_hrd_id'] = 1;
        }
        if ($role_id == 2) {
            $attr['acc_mandiv_id'] = 3;
            $attr['acc_hrd_id'] = 1;
        }
        // dd($attr);`
        auth()->user()->cutis()->create($attr);
        session()->flash('success', 'Permintaan anda sudah diajukan');
        session()->flash('error', 'Permintaan anda gagal diajukan');

        return redirect(route('cuti.index'));
    }
    public function edit(Cuti $cuti)
    {
        $cutis = Cuti::where([
            ['user_id', '=', $cuti->user->id],
            ['kategori_id', '=', 1],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_mulai', '=', now()->year)->get();
        $totalCuti = 0;
        foreach ($cutis as $c) {
            $datetime1 = new DateTime($c->tgl_mulai);
            $datetime2 = new DateTime($c->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;
            $totalCuti += $days;
        }
        $sisaCutis = 12 - $totalCuti;
        $role_id = Auth::user()->role_id;
        return view('cuti.edit', [
            'role' => $role_id,
            'cuti' => $cuti,
            'sisaCutis' => $sisaCutis,
            'kategoris' => Kategori::get(),
            'acc_mandivs' => Acc_mandiv::get(),
            'acc_hrds' => Acc_hrd::get(),
        ]);
    }

    public function update(CutiRequest $request, Cuti $cuti)
    {
        $role_id = Auth::user()->role_id;
        $attr = $request->all();
        $attr['kategori_id'] = request('kategori');
        $attr['acc_mandiv_id'] = request('acc_mandiv');
        $attr['acc_hrd_id'] = request('acc_hrd');

        //check cuti tahunan tidak melebihi sisa cuti
        if ($request->kategori == 1) {
            $datetime1 = new DateTime($request->tgl_mulai);
            $datetime2 = new DateTime($request->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;

            if ($days > $request->sisa_cuti) {
                session()->flash('error', 'Permintaan anda gagal diajukan, Melebihi kuota cuti tahunan');
                return redirect(route('cuti.admin'));
            }
        }

        //kondisi status persetujuan
        //1 = diproses
        //2 = ditolak
        //3 = disetujui

        if (request('acc_mandiv') == 1) {
            $attr['acc_hrd_id'] = 4;
        } elseif (request('acc_mandiv') == 2) {
            $attr['acc_hrd_id'] = 2;
        } elseif (request('acc_mandiv') == 3 && !request('acc_hrd')) {
            $attr['acc_hrd_id'] = 1;
        } elseif (request('acc_mandiv') == 3 && request('acc_hrd') == 4) {
            $attr['acc_hrd_id'] = 1;
        } elseif (request('acc_mandiv') == 3 && request('acc_hrd') == 2 && $role_id == 2) {
            $attr['acc_hrd_id'] = 1;
        }
        $cuti->update($attr);

        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('cuti.admin'));
    }

    public function destroy(Cuti $cuti)
    {
        $cuti->delete();
        session()->flash('error', 'Data pengajuan terhapus!');
        session()->flash('error', 'Data pengajuan gagal terhapus!');
        return redirect(route('cuti.admin'));
    }

    //delete all data cuti 
    //not used
    public function destroyAll()
    {
        Cuti::truncate();
        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('cuti.admin'));
    }

    public function export()
    {
        return Excel::download(new CutiExport(), 'rekap-cuti.xlsx');
        return redirect("route('rekap.cuti')");
    }

    public function lampiran(Cuti $cuti)
    {
        return view('cuti.lampiran', compact('cuti'));
    }
}
