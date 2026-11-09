<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Peminjaman;
use App\Policies\PeminjamanPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate untuk pengelolaan buku (Soal 3)
        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // Policy untuk melihat detail peminjaman (Soal 4)
        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
    }
}