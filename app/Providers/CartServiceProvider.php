<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CartInterfaceRepository;
use App\Repositories\CartSessionRepository;

class CartServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(CartInterfaceRepository::class, CartSessionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
