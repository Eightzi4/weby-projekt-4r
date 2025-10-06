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
            $leftItems = NavbarItem::where('align', 'left')
                ->whereNull('parent_id')
                ->orderBy('order')
                ->get();

            $rightItems = NavbarItem::where('align', 'right')
                ->whereNull('parent_id')
                ->orderBy('order')
                ->get();

            $view->with([
                'leftNavItems' => $leftItems,
                'rightNavItems' => $rightItems
            ]);
        });
    }
}
