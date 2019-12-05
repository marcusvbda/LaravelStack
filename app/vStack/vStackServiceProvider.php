<?php

namespace App\vStack;

use Illuminate\Support\ServiceProvider;
use App\vStack\Commands\{createResource,createFilter};

class vStackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'vStack');
        $this->commands([
            createResource::class,
            createFilter::class,
        ]);
    }
}
