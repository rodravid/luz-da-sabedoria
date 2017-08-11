<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */
    'roles' => [
        'entity' => App\Domain\ACL\Role\Role::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Available drivers: config|doctrine
    | When set to config, add the permission names to list
    |
    */
    'permissions' => [
        'driver' => 'config',
        'entity' => App\Domain\ACL\Permission\Permission::class,
        'list'   => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Organisations
    |--------------------------------------------------------------------------
    */
    'organisations' => [
        'entity' => App\Domain\ACL\Organisation::class,
    ],
];
