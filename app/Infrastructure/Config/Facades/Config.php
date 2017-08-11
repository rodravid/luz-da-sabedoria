<?php

namespace App\Infrastructure\Config\Facades;

use Illuminate\Support\Facades\Facade;

class Config extends Facade
{
    public static function getFacadeAccessor()
    {
        return \App\Infrastructure\Config\Config::class;
    }
}