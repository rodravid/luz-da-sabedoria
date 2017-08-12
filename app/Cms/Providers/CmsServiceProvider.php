<?php

namespace App\Cms\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\\Cms\\Http';

    public function boot()
    {
        parent::boot();

        $this->registerComposers();
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
    }

    public function map(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace,
            'prefix'    => 'cms',
            'as'        => 'cms.'
        ], function ($route)
        {
            require __DIR__ . '/../Http/routes.php';
        });
    }

    protected function registerComposers()
    {
        $this->app['view']->composer('cms::layouts.partials.menu', 'App\Cms\Http\ViewComposers\MenuComposer');
    }

}