<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Izin;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengajuan_anggaran;
use App\Models\Realisasi_anggaran;
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
        $pinjam = Peminjaman::count();
        $count_pengajuan = Pengajuan_anggaran::count();
        // $count_realisasi = Realisasi_anggaran::count();

        $new_pengajuan = Pengajuan_anggaran::where('acc_adminkeu_id', 1)->get();

        $usersKaryawan = User::whereBetween('role_id', [2, 3])->get();
        $usersPengurus = User::where('role_id', 4, 'ASC')->get();


        return view('dashboard', compact(
            'user', 
            'cuti', 
            'pinjam', 
            'izin', 
            'isCuti', 
            'isIzin', 
            'usersKaryawan', 
            'usersPengurus',
            'count_pengajuan',
            'new_pengajuan'
        ));
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
    public function pinjam(Request $request)
    {
        $pinjams = Peminjaman::latest()->whereYear('created_at', '=', $request->query("year"))->get();
        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[$i] = now()->year - $i;
        }
        return view('peminjaman.rekap', compact('pinjams', 'years'));
    }
    public function pengajuanAnggaran(Request $request)
    {
        $pengajuans = Pengajuan_anggaran::latest()->whereYear('created_at', '=', $request->query("year"))->get();
        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[$i] = now()->year - $i;
        }
        return view('pengajuan.rekap', compact('pengajuans', 'years'));
    }
}
