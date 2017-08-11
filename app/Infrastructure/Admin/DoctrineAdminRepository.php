<?php

namespace App\Infrastructure\Admin;

use App\Domain\Admin\Admin;
use App\Domain\Admin\AdminRepository;
use App\Infrastructure\Users\DoctrineUserRepository;

class DoctrineAdminRepository extends DoctrineUserRepository implements AdminRepository
{

    public function create(array $data)
    {
        $admin = Admin::make($data);
        $this->_em->persist($admin);
        $this->_em->flush();
        return $admin;
    }

}