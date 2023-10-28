<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan_anggaran;
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
            'file_anggaran' => 'required|mimes:PDF,pdf,svg,xlsx,xls|max:2048',
            'email' => 'required|email',
            'no_tlp'=> 'required',
            'bidang' => 'required',
            'nama_user'=> 'required'
        ]);


        // $foto = $request->gambar;
        // $namafile = time().'.'.$foto->getClientOriginalExtension();

        // Image::make($foto)->save('thumb/'.$namafile);
        // $foto->move('public/images/', $namafile);

        // $produk->gambar = $namafile;
        // $produk->save();
 
        $name = $request->file('file_anggaran')->getClientOriginalName();

        $path = $request->file('file_anggaran');

        $path->move('files/pengajuan_anggaran/', $name);

        // $pengajuan = new Pengajuan_anggaran;

        // $pengajuan->file_anggaran = $name;
        // $pengajuan->path = $path;

        // $lampiran = request()->file('lampiran')->store("images/peminjaman");

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
