<?php

namespace App\Providers;

use App\Models\Navbar;
use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('blog_Structure.Layouts.navItemWidget', function ($view) {
            $view->with('links', Navbar::orderByDesc('order')->whereStatus(1)->get());
        });
    }
}