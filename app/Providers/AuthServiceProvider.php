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

        //--------------------- Ini adalah role authorization tindakan user -----------------

        Gate::define('pengajuan', function ($user) {
            return $user->role_id === 2 || $user->role_id === 3 || $user->role_id === 4;
        });
        Gate::define('peminjaman', function ($user) {
            return $user->role_id === 2 || $user->role_id === 3;
        });
        Gate::define('persetujuan', function ($user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });
        Gate::define('persetujuanPinjam', function ($user) {
            return $user->role_id === 1;
        });
        Gate::define('pengelolaan', function ($user) {
            return $user->role_id === 1;
        });
        Gate::define('edit', function ($user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });
        Gate::define('update', function ($user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });
        Gate::define('delete', function ($user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });
        Gate::define('daftar', function ($user) {
            return $user->role_id === 1;
        });
    }
}
