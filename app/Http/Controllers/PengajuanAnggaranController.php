<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan_anggaran;
use App\Models\Acc_adminkeu;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanAnggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $pengajuans = Pengajuan_anggaran::where('user_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);
        return view('pengajuan.index', compact('pengajuans'));
    }

    public function adminkeu()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 5) {
            $pengajuans = Pengajuan_anggaran::orderBy('id', 'desc')->latest()->simplePaginate(12);
        } else {
            $pengajuans = Pengajuan_anggaran::whereHas('user', function ($query) {
                $divisi_id = Auth::user()->divisi_id;
                $query->whereDivisiId($divisi_id);
            })->latest()->simplePaginate(12);
        }

        return view('pengajuan.admin', compact('pengajuans', 'role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi lampiran anggaran dan formulir
        $request->validate([
            'file_anggaran' => 'required|mimes:PDF,pdf,xlsx,xls|max:2048',
            'email' => 'required|email|max:30',
            'no_tlp'=> 'required|numeric|min:10',
            'bidang' => 'required',
            'nama_user'=> 'required|regex:/[a-zA-Z\s]+/|max:30',
        ]);
 
        $name = $request->file('file_anggaran')->getClientOriginalName();

        $path = $request->file('file_anggaran');

        $path->move('files/pengajuan_anggaran/', $name);

        $divisi_id = Auth::user()->divisi_id;
        $role_id = Auth::user()->role_id;

        $attr = $request->all();
        $attr['slug'] = Str::random(9);
        $attr['file_anggaran'] = $name;

        //create peminjaman
        auth()->user()->pengajuanAnggarans()->create($attr);
        session()->flash('success', 'Pengajuan anggaran anda sudah diajukan!');
        session()->flash('error', 'Pengajuan anggaran anda gagal diajukan!');

        return redirect(route('pengajuan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan_anggaran $pengajuan)
    {
        return view('pengajuan.show', compact('pengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan_anggaran $pengajuan)
    {
        $role_id = Auth::user()->role_id;
        return view('pengajuan.edit', [
            'role' => $role_id,
            'pengajuan' => $pengajuan,
            'acc_adminkeus' => Acc_adminkeu::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan_anggaran $pengajuan)
    {
        $role_id = Auth::user()->role_id;
        $attr = $request->all();
       
        $attr['acc_adminkeu_id'] = request('acc_adminkeu');

        //pengkondisian status acc, saling berelasi antara acc mandiv dan acc hrd
        // 1 = diproses, 2 = ditolak, 3 = disetujui, (acc hrd, 4 = - ) 
        
        $pengajuan->update($attr);

        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('pengajuan.adminkeu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan_anggaran $pengajuan)
    {
        $pengajuan->delete();
        session()->flash('success', 'Data pengajuan terhapus!');
        session()->flash('error', 'Data pengajuan gagal terhapus!');
        return redirect(route('pengajuan.adminkeu'));
    }

    //hapus semua data, tidak digunakan di sistem
    public function destroyAll()
    {
        Pengajuan_anggaran::truncate();
        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('cuti.admin'));
    }

    public function export()
    {
        return Excel::download(new PengajuanExport(), 'rekap-pengajuan-anggaran.xlsx');
        return redirect("route('rekap.pengajuanAnggaran')");
    }
    public function lampiran(Pengajuan_anggaran $pengajuan)
    {
        return view('pengajuan.lampiran', compact('pengajuan'));
    }
}
