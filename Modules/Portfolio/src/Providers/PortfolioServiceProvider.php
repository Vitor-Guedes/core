<?php

namespace Portfolio\Providers;

use Illuminate\Support\ServiceProvider;
use Portfolio\Http\Middleware\RedirectTemplate;

class PortfolioServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'portfolio');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations'); 
    }

    public function register()
    {
      
    }
}