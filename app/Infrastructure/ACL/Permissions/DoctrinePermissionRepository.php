<?php

namespace App\Infrastructure\ACL\Permissions;

use App\Domain\ACL\Permission\PermissionRepository;
use App\Infrastructure\Common\DoctrineBaseRepository;

class DoctrinePermissionRepository extends DoctrineBaseRepository implements PermissionRepository
{

    public function getAll()
    {
        return $this->createQueryBuilder('o')->getQuery()->getResult();
    }

    public function findByName($name)
    {
        return $this->findBy(['name' => $name]);
    }
}