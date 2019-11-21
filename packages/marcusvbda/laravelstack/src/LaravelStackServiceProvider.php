<?php

namespace marcusvbda\laravelstack;

use Illuminate\Support\ServiceProvider;

class LaravelStackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'laravelstack');
        $this->publishes([
            __DIR__ . '/config' => config_path(),
            __DIR__ . '/migrations' => database_path('migrations/'),
            __DIR__ . '/Resources/views' => resource_path('views/laravelstack')
        ]);
    }

    public function register()
    {
        $this->registerControllers();
        $this->app['router']->pushMiddlewareToGroup('laravelstack_auth', Http\Middleware\AuthMiddleware::class);
    }

    private function registerControllers()
    {
        $this->app->make(Http\Controllers\AuthController::class);
    }
}
