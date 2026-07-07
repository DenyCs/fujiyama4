<?php

namespace Modules\Client\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Cart\Models\Cart;

class ClientServiceProvider extends ServiceProvider
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
        // Register the Client module's view namespace
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'client');

        // Share $cartCount to ALL views extended from the Client module
        // so the navbar badge always has the correct count on full page loads.
        View::composer('client::*', function ($view) {
            try {
                $cartCount = Cart::getCurrent()->items()->count();
            } catch (\Throwable $e) {
                $cartCount = 0;
            }
            $view->with('cartCount', $cartCount);
        });
    }
}