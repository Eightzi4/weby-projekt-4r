<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\NavbarItem;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sdílí data se specifickou šablonou
        View::composer('layouts.partials.navbar', function ($view) {

            // Položky pro veřejný frontend (vlevo)
            $frontendItems = NavbarItem::where('is_admin_item', false)
                ->whereNull('parent_id')
                ->orderBy('order')
                ->get();

            // Položky pro administraci (vpravo, v dropdownu)
            $adminItems = collect(); // Prázdná kolekce jako výchozí
            if (Auth::check()) {
                 $adminItems = NavbarItem::where('is_admin_item', true)
                    ->where('requires_auth', true)
                    ->whereNull('parent_id')
                    ->orderBy('order')
                    ->get();
            }

            $view->with([
                'frontendNavItems' => $frontendItems,
                'adminNavItems' => $adminItems
            ]);
        });
    }
}