<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vytvoří uživatele pouze pokud ještě neexistuje uživatel s tímto e-mailem.
        User::firstOrCreate(
            [
                'email' => 'admin@example.com'
            ],
            [
                'name' => 'Admin',
                'password' => 'password', // Heslo bude automaticky zahashováno díky nastavení v modelu User
            ]
        );
    }
}