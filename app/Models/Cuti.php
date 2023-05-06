<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cuti extends Model
{
    use HasFactory;
    protected $table = 'cuti';

    protected $fillable = ['slug', 'user_id', 'kategori_id', 'acc_mandiv_id', 'acc_hrd_id', 'tgl_mulai', 'tgl_selesai', 'keterangan', 'lampiran'];

    protected $with = ['user', 'kategori', 'acc_hrd', 'acc_mandiv'];



    public function getTakeImageCutiAttribute()
    {
        return "/storage/" . $this->lampiran;
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
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
