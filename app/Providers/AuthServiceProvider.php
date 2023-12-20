<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // -------------------- Ini adalah role authorization user--------------------

        Gate::define('isAdmin', function ($user) {
            return $user->role_id == '1';
        });
        Gate::define('isMandiv', function ($user) {
            return $user->role_id == '2';
        });
        Gate::define('isKaryawan', function ($user) {
            return $user->role_id == '3';
        });
        Gate::define('isPengurus', function ($user) {
            return $user->role_id == '4';
        });

        Gate::define('isAdminkeu', function ($user) {
            return $user->role_id == '5';
        });
        Gate::define('isBidang', function ($user) {
            return $user->role_id == '6';
        });

        //--------------------- Ini adalah role authorization tindakan user -----------------

        Gate::define('pengajuanMenu', function ($user) { //pengajuan menu sidebar
            return $user->role_id == 2 || $user->role_id == 3 || $user->role_id == 4 || $user->role_id == 6;
        });
        Gate::define('pengajuan', function ($user) { //pengajuann izin
            return $user->role_id == 2 || $user->role_id == 3;
        });
        Gate::define('pengajuanUniversal', function ($user) { //pengajuan cuti
            return $user->role_id == 2 || $user->role_id == 3 || $user->role_id == 4;
        });
        Gate::define('peminjaman', function ($user) { //pengajuan peminjaman dana
            return $user->role_id == 2 || $user->role_id == 3;
        });

        Gate::define('persetujuanMenu', function ($user) { //persetujuan menu sidebar
            return $user->role_id == 1 || $user->role_id == 2 || $user->role_id == 5;
        });
        Gate::define('persetujuan', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });
        Gate::define('persetujuanPinjam', function ($user) {
            return $user->role_id == 1;
        });
        Gate::define('pengelolaan', function ($user) { //kelola user
            return $user->role_id == 1;
        });
        Gate::define('edit', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });
        Gate::define('update', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });
        Gate::define('delete', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });
        Gate::define('daftar', function ($user) {
            return $user->role_id == 1;
        });

        Gate::define('pengajuanAnggaran', function($user) {
            return $user->role_id == 6;
        });
        Gate::define('persetujuanAnggaran', function ($user) {
            return $user->role_id == 5;
        });
        Gate::define('adminAnggaran', function ($user) {
            return $user->role_id == 5;
        });
        Gate::define('editRealisasi', function ($user) {
            return $user->role_id == 5 || $user->role_id == 6;
        });
        Gate::define('editPengajuan', function ($user) {
            return $user->role_id == 5 || $user->role_id == 6;
        });
    }
}
