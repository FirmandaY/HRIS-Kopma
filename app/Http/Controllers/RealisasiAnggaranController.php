<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Realisasi_anggaran;
use App\Models\Acc_adminkeu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class RealisasiAnggaranController extends Controller
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
        $realisasis = Realisasi_anggaran::where('user_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);
        return view('realisasi.index', compact('realisasis'));
    }

    public function adminkeu()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id == 5) {
            $realisasis = Realisasi_anggaran::orderBy('id', 'desc')->latest()->simplePaginate(12);
        } else {
            $realisasis = Realisasi_anggaran::whereHas('user', function ($query) {
                $divisi_id = Auth::user()->divisi_id;
                $query->whereDivisiId($divisi_id);
            })->latest()->simplePaginate(12);
        }

        return view('realisasi.admin', compact('realisasis', 'role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('realisasi.create');
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
            'foto_spj' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'file_realisasi' => 'required|mimes:PDF,pdf,xlsx,xls|max:1048',
            'file_bukti_transaksi' => 'required|mimes:PDF,pdf|max:2048',
            'foto_bukti_pengembalian' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'email' => 'required|email|max:30',
            'no_tlp'=> 'required|numeric|min:10',
            'bidang' => 'required',
            'nama_user'=> 'required|regex:/[a-zA-Z\s]+/|max:30',
            'no_spj' => 'required|numeric|min:3',
            'sisa_anggaran' => 'required|numeric'
        ]);

        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
        $path_foto_spj = $request->file('foto_spj');
        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);
 
        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
        $path_file_realisasi = $request->file('file_realisasi');
        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

        $divisi_id = Auth::user()->divisi_id;
        $role_id = Auth::user()->role_id;

        $attr = $request->all();
        $attr['slug'] = Str::random(9);
        $attr['foto_spj'] = $name_foto_spj;
        $attr['file_realisasi'] = $name_file_realisasi;
        $attr['file_bukti_transaksi'] = $name_file_bukti_transaksi;
        $attr['foto_bukti_pengembalian'] = $name_foto_bukti_pengembalian;

        //create peminjaman
        auth()->user()->realisasiAnggarans()->create($attr);
        session()->flash('success', 'Pengajuan realisasi anggaran anda sudah diajukan!');
        session()->flash('error', 'Pengajuan realisasi anggaran anda gagal diajukan!');

        return redirect(route('realisasi.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Realisasi_anggaran $realisasi)
    {
        return view('realisasi.show', compact('realisasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Realisasi_anggaran $realisasi)
    {
        $role_id = Auth::user()->role_id;
        return view('realisasi.edit', [
            'role' => $role_id,
            'realisasi' => $realisasi,
            'acc_adminkeus' => Acc_adminkeu::get(),
        ], compact('role_id'));
    }

    public function revisi(Realisasi_anggaran $realisasi)
    {
        $role_id = Auth::user()->role_id;
        return view('realisasi.revisi', [
            'role' => $role_id,
            'realisasi' => $realisasi,
            'acc_adminkeus' => Acc_adminkeu::get(),
        ], compact('role_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Realisasi_anggaran $realisasi)
    {
        $role_id = Auth::user()->role_id;
        $attr = $request->all();
       
        $attr['acc_adminkeu_id'] = request('acc_adminkeu');
        
        $realisasi->update($attr);

        session()->flash('success', 'Tanggapan anda sudah disimpan!');
        session()->flash('error', 'Tanggapan anda gagal disimpan!');
        return redirect(route('realisasi.adminkeu'));
    }

    public function updateRevisi(Request $request, Realisasi_anggaran $realisasi)
    {
        $request->validate([
            'foto_spj' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'file_realisasi' => 'nullable|mimes:PDF,pdf,xlsx,xls|max:1048',
            'file_bukti_transaksi' => 'nullable|mimes:PDF,pdf|max:2048'
        ]);

        $role_id = Auth::user()->role_id;
        $attr = $request->all();

        if ($request->file('foto_spj')){
            if ($request->file('file_realisasi')){
                if ($request->file('file_bukti_transaksi')){
                    if($request->file('foto_bukti_pengembalian')){
                        File::delete('files/foto_spj/'.$realisasi->foto_spj); //data foto yang lama dihapus dulu
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);
                        
                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);


                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_realisasi' => $name_file_realisasi,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/foto_spj/'.$realisasi->foto_spj); //data foto yang lama dihapus dulu
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);
                        
                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_realisasi' => $name_file_realisasi,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }
                    

                } else{ //jika bukti transaksi tidak diperbarui
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/foto_spj/'.$realisasi->foto_spj);
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);


                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_realisasi' => $name_file_realisasi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/foto_spj/'.$realisasi->foto_spj);
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_realisasi' => $name_file_realisasi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }
                    
                }

            } else{ //jika file realisasi tidak diperbarui
                if ($request->file('file_bukti_transaksi')){
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/foto_spj/'.$realisasi->foto_spj);
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/foto_spj/'.$realisasi->foto_spj);
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }
                    
                } else{
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/foto_spj/'.$realisasi->foto_spj); //data foto yang lama dihapus dulu
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian

                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/foto_spj/'.$realisasi->foto_spj); //data foto yang lama dihapus dulu
                        $name_foto_spj = $request->file('foto_spj')->getClientOriginalName();
                        $path_foto_spj = $request->file('foto_spj');
                        $path_foto_spj->move('files/foto_spj/', $name_foto_spj);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_spj' => $name_foto_spj

                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }
                    
                }
            }

        } else { //jika foto spj tidak diperbarui
            if ($request->file('file_realisasi')){
                if ($request->file('file_bukti_transaksi')){
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);


                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_realisasi' => $name_file_realisasi,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_realisasi' => $name_file_realisasi,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }
                    

                } else{
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_realisasi' => $name_file_realisasi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/realisasi_anggaran/'.$realisasi->file_realisasi);
                        $name_file_realisasi = $request->file('file_realisasi')->getClientOriginalName();
                        $path_file_realisasi = $request->file('file_realisasi');
                        $path_file_realisasi->move('files/realisasi_anggaran/', $name_file_realisasi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_realisasi' => $name_file_realisasi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }

                }
            } else{
                if ($request->file('file_bukti_transaksi')){
                    if($request->file('foto_bukti_pengembalian')){
                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        File::delete('files/bukti_transaksi/'.$realisasi->file_bukti_transaksi);
                        $name_file_bukti_transaksi = $request->file('file_bukti_transaksi')->getClientOriginalName();
                        $path_file_bukti_transaksi = $request->file('file_bukti_transaksi');
                        $path_file_bukti_transaksi->move('files/bukti_transaksi/', $name_file_bukti_transaksi);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'file_bukti_transaksi' => $name_file_bukti_transaksi
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));
                    }

                } else{
                    if ($request->file('foto_bukti_pengembalian')){
                        File::delete('files/bukti_pengembalian/'.$realisasi->foto_bukti_pengembalian);
                        $name_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian')->getClientOriginalName();
                        $path_foto_bukti_pengembalian = $request->file('foto_bukti_pengembalian');
                        $path_foto_bukti_pengembalian->move('files/bukti_pengembalian/', $name_foto_bukti_pengembalian);

                        $realisasi->update([
                            'acc_adminkeu_id' => 1,
                            'foto_bukti_pengembalian' => $name_foto_bukti_pengembalian
                        ]);
            
                        session()->flash('success', 'Perubahan data anda sudah disimpan!');
                        session()->flash('error', 'Perubahan data anda gagal disimpan!');
                        return redirect(route('realisasi.index'));

                    } else{
                        return redirect()->back();
                    }
                    
                }
            }
        }
        
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
