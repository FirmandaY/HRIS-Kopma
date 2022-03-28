<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Izin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $user = User::count();
        $isCuti = Cuti::join('users', 'users.id', '=', 'cuti.user_id')
            ->join('divisi', 'users.divisi_id', '=', 'divisi.id')
            ->select('users.name', 'cuti.tgl_selesai', 'divisi.nama')
            ->where('acc_hrd_id', 3)
            ->whereDate('tgl_mulai', '<=', Carbon::today())
            ->whereDate('tgl_selesai', '>=', Carbon::today())
            ->get();
        $isIzin = Izin::join('users', 'users.id', '=', 'izin.user_id')
            ->join('divisi', 'users.divisi_id', '=', 'divisi.id')
            ->select('users.name', 'nik', 'divisi.nama', 'izin.wkt_mulai', 'izin.wkt_selesai')
            ->where('acc_hrd_id', 3)
            ->whereDate('tgl_izin', '=', Carbon::today())
            ->get();
        $cuti = Cuti::count();
        $izin = Izin::count();

        $usersKaryawan = User::whereBetween('role_id', [2, 3])->get();
        $usersPengurus = User::where('role_id', 4, 'ASC')->get();


        return view('dashboard', compact('user', 'cuti', 'izin', 'isCuti', 'isIzin', 'usersKaryawan', 'usersPengurus'));
    }
    public function cuti(Request $request)
    {
        $cutis = Cuti::latest()->whereYear('tgl_mulai', '=', $request->query("year"))->get();
        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[$i] = now()->year - $i;
        }
        return view('cuti.rekap', compact('cutis', 'years'));
    }
    public function izin(Request $request)
    {
        $izins = Izin::latest()->whereYear('tgl_izin', '=', $request->query("year"))->get();
        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[$i] = now()->year - $i;
        }
        return view('izin.rekap', compact('izins', 'years'));
    }
}
