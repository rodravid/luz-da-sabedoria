<?php

namespace App\Infrastructure;

use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Storage\StorageService;

class InfrastructureServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {

        $this->registerRepository(
            'App\Domain\User\UserRepository',
            'App\Infrastructure\User\DoctrineUserRepository',
            'App\Domain\User\User'
        );
        $this->registerRepository(
            'App\Domain\Admin\AdminRepository',
            'App\Infrastructure\Admin\DoctrineAdminRepository',
            'App\Domain\Admin\Admin'
        );

        $this->registerRepository(
            'App\Domain\ACL\Role\RoleRepository',
            'App\Infrastructure\ACL\Roles\DoctrineRoleRepository',
            'App\Domain\ACL\Role\Role'
        );

        $this->registerRepository(
            'App\Domain\ACL\Permission\PermissionRepository',
            'App\Infrastructure\ACL\Permissions\DoctrinePermissionRepositoryCached',
            'App\Domain\ACL\Permission\Permission'
        );

        $this->registerRepository(
            'App\Domain\ACL\Module\ModuleRepository',
            'App\Infrastructure\ACL\Modules\DoctrineModuleRepositoryCached',
            'App\Domain\ACL\Module\Module'
        );

        $this->app->singleton('App\Infrastructure\Storage\StorageService', function() {
            return new StorageService($this->app['filesystem'], $this->app['config']);
        });

    }

    protected function registerRepository($repositoryInterfaceClass, $concreteRepository, $entityClass)
    {
        $this->app->singleton($repositoryInterfaceClass, function($app) use ($concreteRepository, $entityClass) {
            $entityManager = $app['em'];

            return new $concreteRepository(
                $entityManager,
                $entityManager->getClassMetaData($entityClass)
            );
        });
    }

    public function provides()
    {
        return [
            'App\Domain\User\UserRepository',
            'App\Domain\Admin\AdminRepository',
            'App\Domain\ACL\Role\RoleRepository',
            'App\Domain\ACL\Permission\PermissionRepository',
            'App\Domain\ACL\Module\ModuleRepository',
            'App\Infrastructure\Storage\StorageService',
        ];
    }

}