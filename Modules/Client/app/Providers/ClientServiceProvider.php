<?php

namespace Modules\Client\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Cart\Models\Cart;
use Modules\Setting\Models\RestaurantSetting;
use Modules\Setting\Models\SocialLink;

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

        // Share $cartCount, $socialLinks, and $restaurantSetting to ALL client views
        View::composer('client::*', function ($view) {
            try {
                $cartCount = Cart::getCurrent()->items()->count();
            } catch (\Throwable $e) {
                $cartCount = 0;
            }
            $view->with('cartCount', $cartCount);

            try {
                $socialLinks = SocialLink::active()->ordered()->get();
            } catch (\Throwable $e) {
                $socialLinks = collect();
            }
            $view->with('socialLinks', $socialLinks);

            try {
                $restaurantSetting = RestaurantSetting::getContent();
            } catch (\Throwable $e) {
                $restaurantSetting = new RestaurantSetting();
            }
            $view->with('restaurantSetting', $restaurantSetting);
        });
    }
}