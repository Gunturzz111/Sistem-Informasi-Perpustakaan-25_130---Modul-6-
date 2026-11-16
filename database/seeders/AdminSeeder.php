<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('SEED_ADMIN_EMAIL');

        if (blank($email)) {
            throw new RuntimeException('SEED_ADMIN_EMAIL wajib diisi sebelum menjalankan seeder.');
        }

        $admin = User::firstOrNew(['email' => $email]);

        if (! $admin->exists) {
            $password = env('SEED_ADMIN_PASSWORD');

            if (blank($password)) {
                throw new RuntimeException('SEED_ADMIN_PASSWORD wajib diisi untuk membuat akun admin baru.');
            }

            $admin->name = env('SEED_ADMIN_NAME', 'Administrator');
            $admin->password = $password;
            $admin->save();
        }

        $admin->assignRole('admin');
    }
}
