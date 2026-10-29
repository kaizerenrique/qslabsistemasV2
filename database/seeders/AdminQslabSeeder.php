<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminQslabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('QSLAB_ADMIN_EMAIL', 'admin@qslab.com');

        $admin = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Qslab Admin',
                'password' => Hash::make(env('QSLAB_ADMIN_PASSWORD', 'cambiar-esta-clave')),
                'email_verified_at' => now(),
            ]
        );

        if (! $admin->hasRole('SuperAdmin')) {
            $admin->assignRole('SuperAdmin');
        }
    }
}
