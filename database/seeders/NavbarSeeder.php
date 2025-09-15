<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NavbarItem;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Frontend položky
        NavbarItem::firstOrCreate(['route' => 'home'], [
            'title' => 'Home',
            'order' => 1,
            'is_admin_item' => false
        ]);

        NavbarItem::firstOrCreate(['route' => 'seasons.index'], [
            'title' => 'Sezóny',
            'order' => 2,
            'is_admin_item' => false
        ]);

        NavbarItem::firstOrCreate(['route' => 'teams.index'], [
            'title' => 'Týmy',
            'order' => 3,
            'is_admin_item' => false
        ]);

        // Admin položky
        // Prozatím jen jedna, další můžete přidat později
        NavbarItem::firstOrCreate(['route' => 'home'], [ // Dočasně směřuje na home
            'title' => 'Správa článků',
            'order' => 1,
            'is_admin_item' => true,
            'requires_auth' => true
        ]);
    }
}