<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_anggaran extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_anggaran';
    protected $fillable = 
    [
        'slug', 
        'user_id', 
        'acc_adminkeu_id', 
        'email', 
        'nama_user', 
        'bidang', 
        'no_tlp', 
        'file_anggaran', 
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
