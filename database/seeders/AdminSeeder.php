<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ── ADMIN ──────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@mrsabor.com'],
            [
                'name'     => 'Administrador Mr. Sabor',
                'email'    => 'admin@mrsabor.com',
                'password' => Hash::make('Admin123!'),
                'role'     => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // ── CLIENTE DE PRUEBA ───────────────────────────────
        User::updateOrCreate(
            ['email' => 'cliente@mrsabor.com'],
            [
                'name'     => 'Cliente de Prueba',
                'email'    => 'cliente@mrsabor.com',
                'password' => Hash::make('Cliente123!'),
                'role'     => 'customer',
                'email_verified_at' => now(),
            ]
        );
    }
}
