<?php

namespace App\vStack;

use Illuminate\Support\ServiceProvider;
use App\vStack\Commands\createResource;

class vStackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/resources.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'vStack');
        $this->commands([
            createResource::class
        ]);
    }
}
