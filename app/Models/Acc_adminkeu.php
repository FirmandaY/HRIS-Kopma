<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acc_adminkeu extends Model
{
    use HasFactory;
    protected $table = 'acc_adminkeu';
    protected $fillable = ['nama'];

    public function pengajuanAnggarans()
    {
        return $this->hasMany(Pengajuan_anggaran::class);
    }
    public function realisasiAnggarans()
    {
        return $this->hasMany((Realisasi_anggaran::class));
    }
    
}
