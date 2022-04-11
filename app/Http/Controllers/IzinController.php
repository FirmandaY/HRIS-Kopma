<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use App\Models\{Izin, Acc_mandiv, Acc_hrd};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Exports\IzinExport;
use Maatwebsite\Excel\Facades\Excel;

class IzinController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $izins = Izin::where('user_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);
        return view('izin.index', compact('izins'));
    }
    public function admin()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 1) {
            $izins = Izin::where('acc_mandiv_id', 3)->latest()->simplePaginate(12);
        } else {
            $izins = Izin::whereBetween('acc_mandiv_id', [1,2])->latest()->simplePaginate(20);
            //$izins = Izin::whereHas('user', function ($query) {
            //    $divisi_id = Auth::user()->divisi_id;
            //    $query->whereDivisiId($divisi_id);
            //})->latest()->simplePaginate(12);
        }

        return view('izin.admin', compact('izins', 'role_id'));
    }

    public function create()
    {
        return view('izin.create');
    }
    public function store(IzinRequest $request)
    {
        //validasi lampiran
        $request->validate([
            'lampiran' => 'image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if (request()->file('lampiran')) {
            $lampiran = request()->file('lampiran')->store("images/izin");
        } else {
            $lampiran = null;
        }

        $divisi_id = Auth::user()->divisi_id;
        $role_id = Auth::user()->role_id;

        $attr = $request->all();
        $attr['slug'] = Str::random(9);
        $attr['lampiran'] = $lampiran;

        //jika divisi non divisi,langsung menuju hrd
        if ($divisi_id == 5) {
            $attr['acc_mandiv_id'] = 3;
            $attr['acc_hrd_id'] = 1;
        }
        if ($role_id == 2) {
            $attr['acc_mandiv_id'] = 3;
            $attr['acc_hrd_id'] = 1;
        }

        //create izin
        auth()->user()->izins()->create($attr);
        session()->flash('success', 'Permintaan anda sudah diajukan');
        session()->flash('error', 'Permintaan anda gagal diajukan');

        return redirect(route('izin.index'));
    }
    public function show(Izin $izin)
    {
        return view('izin.show', compact('izin'));
    }
    public function edit(Izin $izin)
    {
        $role_id = Auth::user()->role_id;
        return view('izin.edit', [
            'role' => $role_id,
            'izin' => $izin,
            'acc_mandivs' => Acc_mandiv::get(),
            'acc_hrds' => Acc_hrd::get(),
        ]);
    }
    public function update(IzinRequest $request, Izin $izin)
    {
        $role_id = Auth::user()->role_id;
        $attr = $request->all();
        $attr['acc_mandiv_id'] = request('acc_mandiv');
        $attr['acc_hrd_id'] = request('acc_hrd');

        //pengkondisian status acc, saling berelasi antara acc mandiv dan acc hrd
        // 1 = diproses, 2 = ditolak, 3 = disetujui, (acc hrd, 4 = - ) 
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
        $izin->update($attr);

        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('izin.admin'));
    }

    public function destroy(Izin $izin)
    {
        $izin->delete();
        session()->flash('success', 'Data pengajuan terhapus!');
        session()->flash('error', 'Data pengajuan gagal terhapus!');
        return redirect(route('izin.admin'));
    }

    //hapus semua data, tidak digunakan di sistem
    public function destroyAll()
    {
        Izin::truncate();
        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('cuti.admin'));
    }

    public function export()
    {
        return Excel::download(new IzinExport(), 'rekap-izin.xlsx');
        return redirect("route('rekap.izin')");
    }
    public function lampiran(Izin $izin)
    {
        return view('izin.lampiran', compact('izin'));
    }
}
