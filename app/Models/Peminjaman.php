<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = ['slug', 'user_id', 'acc_hrd_id', 'wkt_pinjam', 
                            'wkt_selesai', 'keterangan', 'lampiran', 'nominal', 'email', 'no_telp'
                        ];
    protected $with = ['user', 'acc_hrd'];

    public function getTakeImageIzinAttribute()
    {
        return "/storage/" . $this->lampiran;
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function acc_hrd()
    {
        return $this->belongsTo(Acc_hrd::class);
    }
}
