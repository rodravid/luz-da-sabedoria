<?php

namespace App\Domain\User;

interface UserRepository
{

    public function create(array $data);

    public function findOrFail($id);

    public function findByEmail($email);

    public function findByRole(array $role);

}