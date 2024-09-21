<?php

namespace Mimachh\LikeIt;

use Illuminate\Support\ServiceProvider;

class LikeItServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        
        // Charger les seeders
        // $this->publishes([
        //     __DIR__ . '/../database/seeders' => database_path('seeders'),
        // ], 'like-it-seeders');

        // $this->publishes([
        //     __DIR__ . '/../config/like-it.php' => config_path('like-it.php'),
        // ], 'like-it-config');
        
    }

    public function register()
    {
        //
    }
}
