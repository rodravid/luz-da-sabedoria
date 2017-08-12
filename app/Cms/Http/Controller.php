<?php
namespace App\Cms\Http;

use App\Cms\Http\User\Presenters\DefaultUserPresenter;
use App\Core\Http\Controllers\Controller as CoreController;
use Auth;

class Controller extends CoreController
{

    protected $viewNamespace = 'cms';

    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('cms')->user();
        view()->share('loggedUser', new DefaultUserPresenter($this->user));
    }

}