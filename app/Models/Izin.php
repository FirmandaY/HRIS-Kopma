<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $table = 'izin';
    protected $fillable = ['slug', 'user_id', 'acc_mandiv_id', 'acc_hrd_id', 'tgl_izin', 'wkt_mulai', 'wkt_selesai', 'keterangan', 'lampiran'];
    protected $with = ['user', 'acc_hrd', 'acc_mandiv'];

    public function getTakeImageIzinAttribute()
    {
        return "/storage/" . $this->lampiran;
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function acc_mandiv()
    {
        return $this->belongsTo(Acc_mandiv::class);
    }
    public function acc_hrd()
    {
        return $this->belongsTo(Acc_hrd::class);
    }
}
