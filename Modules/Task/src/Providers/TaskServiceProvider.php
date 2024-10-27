<?php

namespace Task\Providers;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'task');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations'); 

        include(__DIR__ . '/../helper.php');
    }

    public function register()
    {
      
    }
}