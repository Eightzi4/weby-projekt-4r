<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\NavbarItem;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts._navbar', function ($view) {
            $frontendItems = NavbarItem::where('is_admin_item', false)
                ->whereNull('parent_id')
                ->orderBy('order')
                ->get();

            $adminItems = NavbarItem::where('is_admin_item', true)
                ->where('requires_auth', true)
                ->whereNull('parent_id')
                ->orderBy('order')
                ->get();

            $view->with([
                'frontendNavItems' => $frontendItems,
                'adminNavItems' => $adminItems
            ]);
        });
    }
}
