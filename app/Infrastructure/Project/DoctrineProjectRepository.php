<?php

namespace App\Infrastructure\Project;

use App\Domain\Project\ProjectRepository;
use App\Infrastructure\Common\DoctrineBaseRepository;

class DoctrineProjectRepository extends DoctrineBaseRepository implements ProjectRepository
{

}