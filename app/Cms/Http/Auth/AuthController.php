<?php

namespace App\Cms\Http\Auth;

use App\Core\Http\Controllers\Auth\LoginController as BaseAuthController;

class AuthController extends BaseAuthController
{

    protected $guard = 'cms';

    protected $loginView = 'cms::auth.login';

    protected $redirectTo = '/cms';

    protected $redirectAfterLogout = '/cms/login';
}