<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi_anggaran extends Model
{
    use HasFactory;
    protected $table = 'realisasi_anggaran';
    protected $fillable = 
    [
        'slug', 
        'user_id', 
        'acc_adminkeu_id', 
        'email', 
        'nama_user', 
        'bidang', 
        'no_tlp', 
        'no_spj', 
        'foto_spj', 
        'file_bukti_transaksi', 
        'file_realisasi', 
        'catatan'
    ];

    protected $with = ['user', 'acc_adminkeu'];

    
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function acc_adminkeu()
    {
        return $this->belongsTo(Acc_adminkeu::class);
    }
}
