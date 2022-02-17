<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Cuti;
use App\Models\Divisi;
use App\Models\Izin;
use App\Models\User;
use App\Models\Role;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class KelolaController extends Controller
{
    public function index()
    {
        $users = User::orderBy('divisi_id', 'ASC')->get();
        return view('user.index', compact('users'));
    }
    public function trashed()
    {
        $users = User::orderBy('divisi_id', 'ASC')->onlyTrashed()->get();
        return view('user.trashed', compact('users'));
    }


    public function create()
    {
        return view('user.create', [
            'roles' => Role::get(),
            'divisis' => Divisi::get(),
        ]);
    }


    public function store(UserRequest $request)
    {
        $request->validate([
            'nik' => 'required|alpha_num|min:3|max:20',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users',
        ]);
        $attr = $request->all();
        $attr['role_id'] = request('role');
        $attr['divisi_id'] = request('divisi');
        $attr['password'] = Hash::make($request['password']);

        if ($attr['role_id'] == 1 && $attr['divisi_id'] > 1) {
            session()->flash('error', 'Permintaan anda gagal diajukan');
            return redirect(route('kelola.index'));
        }
        if ($attr['role_id'] > 1 && $attr['divisi_id'] == 1) {
            session()->flash('error', 'Permintaan anda gagal diajukan');
            return redirect(route('kelola.index'));
        }
        User::create($attr);
        session()->flash('success', 'Data akun karyawan berhasil dibuat');
        session()->flash('error', 'Data akun karyawan gagal dibuat');
        return redirect(route('kelola.index'));
    }



    public function edit(User $user)
    {
        $year = now()->year;
        //jumlah cuti id 1
        $cuti1 = Cuti::where([
            ['user_id', '=', $user->id],
            ['kategori_id', '=', 1],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_mulai', '=', $year)->get();
        $totalCuti1 = 0;
        foreach ($cuti1 as $cuti) {
            $datetime1 = new DateTime($cuti->tgl_mulai);
            $datetime2 = new DateTime($cuti->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;
            $totalCuti1 += $days;
        }
        //jumlah cuti id 2
        $cuti2 = Cuti::where([
            ['user_id', '=', $user->id],
            ['kategori_id', '=', 2],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_mulai', '=', $year)->get();
        $totalCuti2 = 0;
        foreach ($cuti2 as $cuti) {
            $datetime1 = new DateTime($cuti->tgl_mulai);
            $datetime2 = new DateTime($cuti->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;
            $totalCuti2 += $days;
        }
        //jumlah cuti id 3
        $cuti3 = Cuti::where([
            ['user_id', '=', $user->id],
            ['kategori_id', '=', 2],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_mulai', '=', $year)->get();
        $totalCuti3 = 0;
        foreach ($cuti3 as $cuti) {
            $datetime1 = new DateTime($cuti->tgl_mulai);
            $datetime2 = new DateTime($cuti->tgl_selesai);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a') + 1;
            $totalCuti3 += $days;
        }
        $izin = Izin::where([
            ['user_id', '=', $user->id],
            ['acc_hrd_id', '=', 3]
        ])->whereYear('tgl_izin', '=', $year)->count();

        return view('user.edit', [
            'user' => $user,
            'cuti1' => $totalCuti1, //cuti id 1
            'cuti2' => $totalCuti2, //cuti id 2
            'cuti3' => $totalCuti3, //cuti id 3
            'izin' => $izin,
            'roles' => Role::get(),
            'divisis' => Divisi::get()
        ]);
    }



    public function update(UserRequest $request, User $user)
    {
        $attr = $request->all();
        $attr['role_id'] = request('role');
        $attr['divisi_id'] = request('divisi');

        //jika mendaftar admin selain divisi admin
        if ($attr['role_id'] == 1 && $attr['divisi_id'] > 1) {
            session()->flash('error', 'Permintaan anda gagal diajukan');
            return redirect(route('kelola.index'));
        }
        //jika mendaftar bukan admin di divisi admin
        if ($attr['role_id'] > 1 && $attr['divisi_id'] == 1) {
            session()->flash('error', 'Permintaan anda gagal diajukan');
            return redirect(route('kelola.index'));
        }
        $user->update($attr);
        session()->flash('success', 'Data akun karyawan berhasil diperbarui');
        session()->flash('error', 'Data akun karyawan gagal diperbarui');
        return redirect(route('kelola.index'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Data akun karyawan berhasil dihapus');
        session()->flash('error', 'Data akun karyawan gagal dihapus');
        return redirect(route('kelola.index'));
    }
    public function restore(Request $request, $id)
    {
        return "Modul Belum Siap";
    }
}
