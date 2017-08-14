<?php

namespace App\Infrastructure\Project;

use App\Domain\Project\ProjectRepository;
use App\Infrastructure\Common\DoctrineBaseRepository;

class DoctrineProjectRepository extends DoctrineBaseRepository implements ProjectRepository
{

    public function getAllAvailable()
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.status = 1');

        return $qb->getQuery()->getResult();
    }
}