<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NavbarItem;

class NavbarSeeder extends Seeder
{
    public function run(): void
    {
        NavbarItem::truncate();

        NavbarItem::create([
            'route' => 'home',
            'title' => 'Domů',
            'order' => 1,
            'is_admin_item' => false
        ]);

        NavbarItem::create([
            'route' => 'seasons.index',
            'title' => 'Sezóny',
            'order' => 2,
            'is_admin_item' => false
        ]);

        NavbarItem::create([
            'route' => 'teams.index',
            'title' => 'Týmy',
            'order' => 3,
            'is_admin_item' => false
        ]);

        NavbarItem::create([
            'route' => 'admin.articles.index',
            'title' => 'Správa článků',
            'order' => 1,
            'is_admin_item' => true,
            'requires_auth' => true
        ]);

        NavbarItem::create([
            'route' => 'admin.navbar-items.index',
            'title' => 'Správa menu',
            'order' => 2,
            'is_admin_item' => true,
            'requires_auth' => true
        ]);
    }
}
