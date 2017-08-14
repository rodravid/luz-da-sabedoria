<?php

namespace App\Domain;

use Illuminate\Session\SessionInterface;
use Illuminate\Support\ServiceProvider;
use App\Domain\ACL\ACLService;
use App\Domain\Admin\AdminService;

class DomainServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {

        $this->app->singleton('App\Domain\ACL\ACLService', function() {
            return new ACLService(
                $this->app['em'],
                $this->app->make('App\Domain\ACL\Module\ModuleRepository'),
                $this->app->make('App\Domain\ACL\Role\RoleRepository'),
                $this->app->make('App\Domain\ACL\Permission\PermissionRepository')
            );
        });

        $this->app->singleton('App\Domain\Admin\AdminService', function() {
            return new AdminService(
                $this->app['App\Domain\Admin\AdminRepository'],
                $this->app['em'],
                $this->app->make('App\Domain\Admin\AdminValidator'),
                $this->app['App\Infrastructure\Storage\StorageService']
            );
        });
    }

    public function provides()
    {
        return [
            'App\Domain\ACL\ACLService',
            'App\Domain\Admin\AdminService',
        ];
    }
}