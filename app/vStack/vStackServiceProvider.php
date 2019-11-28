<?php

namespace App\vStack;

use Illuminate\Support\ServiceProvider;

class vStackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/resources.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'vStack');
    }
}
