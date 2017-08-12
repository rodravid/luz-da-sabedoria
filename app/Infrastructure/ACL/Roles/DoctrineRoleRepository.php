<?php

namespace App\Infrastructure\ACL\Roles;

use App\Domain\ACL\Role\RoleRepository;
use App\Infrastructure\Common\DoctrineBaseRepository;

class DoctrineRoleRepository extends DoctrineBaseRepository implements RoleRepository
{

    public function getAll()
    {
        $query = $this->_em
            ->createQueryBuilder()
            ->select('role')
            ->from('App\Domain\ACL\Role\Role', 'role')
            ->getQuery();

        return $query->getResult();
    }

}