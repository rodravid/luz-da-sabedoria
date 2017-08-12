<?php

namespace App\Domain\Project;

interface ProjectRepository
{
    public function create(array $data);

    public function findOrFail($id);

    public function store(array $data);
}