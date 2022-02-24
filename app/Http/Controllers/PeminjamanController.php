<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use App\Models\{Peminjaman, Acc_mandiv, Acc_hrd};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $pinjams = Peminjaman::where('user_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);
        return view('peminjaman.index', compact('pinjams'));
    }
    public function admin()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 1) {
            $pinjams = Peminjaman::orderBy('id', 'desc')->latest()->simplePaginate(12);
        } else {
            $pinjams = Peminjaman::whereHas('user', function ($query) {
                $divisi_id = Auth::user()->divisi_id;
                $query->whereDivisiId($divisi_id);
            })->latest()->simplePaginate(12);
        }

        return view('peminjaman.admin', compact('pinjams', 'role_id'));
    }

    public function create()
    {
        return view('peminjaman.create');
    }
    public function store(PeminjamanRequest $request)
    {
        //validasi lampiran
        $request->validate([
            'lampiran' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            'email' => 'required|email',
            'no_telp'=> 'required'
        ]);
        if (request()->file('lampiran')) {
            $lampiran = request()->file('lampiran')->store("images/peminjaman");
        } else {
            $lampiran = null;
        }

        $divisi_id = Auth::user()->divisi_id;
        $role_id = Auth::user()->role_id;

        $attr = $request->all();
        $attr['slug'] = Str::random(9);
        $attr['lampiran'] = $lampiran;

        //jika divisi non divisi,langsung menuju hrd

        //create peminjaman
        auth()->user()->pinjams()->create($attr);
        session()->flash('success', 'Permintaan anda sudah diajukan');
        session()->flash('error', 'Permintaan anda gagal diajukan');

        return redirect(route('pinjam.index'));
    }
    public function show(Peminjaman $pinjam)
    {
        return view('peminjaman.show', compact('pinjam'));
    }
    public function edit(Peminjaman $pinjam)
    {
        $role_id = Auth::user()->role_id;
        return view('peminjaman.edit', [
            'role' => $role_id,
            'pinjam' => $pinjam,
            'acc_hrds' => Acc_hrd::get(),
        ]);
    }
    public function update(PeminjamanRequest $request, Peminjaman $pinjam)
    {
        $role_id = Auth::user()->role_id;
        $attr = $request->all();
       
        $attr['acc_hrd_id'] = request('acc_hrd');

        //pengkondisian status acc, saling berelasi antara acc mandiv dan acc hrd
        // 1 = diproses, 2 = ditolak, 3 = disetujui, (acc hrd, 4 = - ) 
        
        $pinjam->update($attr);

        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('pinjam.admin'));
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        session()->flash('success', 'Data pengajuan terhapus!');
        session()->flash('error', 'Data pengajuan gagal terhapus!');
        return redirect(route('peminjaman.admin'));
    }

    //hapus semua data, tidak digunakan di sistem
    public function destroyAll()
    {
        Peminjaman::truncate();
        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('cuti.admin'));
    }

    public function export()
    {
        return Excel::download(new IzinExport(), 'rekap-peminjaman.xlsx');
        return redirect("route('rekap.peminjaman')");
    }
    public function lampiran(Peminjaman $peminjaman)
    {
        return view('peminjaman.lampiran', compact('peminjaman'));
    }
}
