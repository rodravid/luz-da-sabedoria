<?php

namespace App\Domain\ACL\Permission;


interface PermissionRepository
{

    public function getAll();

    public function findByName($name);

}