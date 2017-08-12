<?php

namespace App\Domain\User\Contracts;

interface HasSettings
{

    public function settings($key = null, $value = null);

}