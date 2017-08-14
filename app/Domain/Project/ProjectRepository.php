<?php

namespace App\Domain\Project;

interface ProjectRepository
{
    public function save($entity);

    public function findOrFail($id);
}