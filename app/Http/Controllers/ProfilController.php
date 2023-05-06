<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Izin;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;


class ProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $year = now()->year;
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
        $cuti3 = Cuti::where([
            ['user_id', '=', $user->id],
            ['kategori_id', '=', 3],
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

        return view('user.profil',
         compact('user', 'cuti1', 'totalCuti1',
          'cuti2', 'totalCuti2',
           'cuti3', 'totalCuti3', 
           'izin'));
    }
}
