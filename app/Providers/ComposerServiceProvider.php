<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('site.partials.wishlist_widget', function ($view) {
            $wishlist_count = 0;
            if (Auth::check()) {
                $wishlist_count = Wishlist::where('user_id', Auth::id())->count();
            }
            $view->with('wishlist_count', $wishlist_count);
        });

        View::composer('site.partials.cart_widget', function ($view) {
            $cart_count = 0;
            if (Auth::check()) {
                $cart_count = \Cart::session(Auth::id())->getContent()->count();
            }
            $view->with('cart_count', $cart_count);
        });
    }
}
