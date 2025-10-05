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
        // Vytvoří uživatele POUZE pokud ještě neexistuje uživatel s tímto e-mailem.
        User::firstOrCreate(
            [
                'email' => 'admin@example.com'
            ],
            [
                'name' => 'Admin',
                'password' => 'password', // Heslo se automaticky zahashuje díky nastavení v modelu User
            ]
        );
    }
}
