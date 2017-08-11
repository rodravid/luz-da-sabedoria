<?php

namespace App\Website\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class WebsiteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\\Website\\Http\\Controllers';

    public function boot()
    {
        parent::boot();

        $this->registerComposers();
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'website');
    }

    public function map(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace,
            'prefix'    => '',
            'as'        => ''
        ], function ($route) {
            require __DIR__ . '/../routes/web.php';
        });
    }

    protected function registerComposers()
    {

    }
}