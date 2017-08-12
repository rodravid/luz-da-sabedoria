<?php

namespace App\Cms\Http\Settings;

use App\Cms\Http\Controller;

class SettingsController extends Controller
{

    public function store($key, $value)
    {
        cmsUser()
            ->settings($key, $value)
            ->save();
    }

}