<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan_anggaran;
use App\Models\Acc_adminkeu;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

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
            'email' => 'required|email',
            'no_tlp'=> 'required',
            'bidang' => 'required',
            'nama_user'=> 'required'
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
