<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acc_mandiv extends Model
{
    use HasFactory;
    protected $table = 'acc_mandiv';
    protected $fillable = ['nama'];
    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
    public function izins()
    {
        return $this->hasMany((Izin::class));
    }
    public function pinjams()
    {
        return $this->hasMany((Peminjaman::class));
    }
}
