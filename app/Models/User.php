<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'divisi_id',
        'name',
        'nik',
        'tgl_lahir',
        'gender',
        'no_hp',
        'email',
        'password',

    ];

    protected $with = [
        'role',
        'divisi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
    public function izins()
    {
        return $this->hasMany(Izin::class);
    }
}
