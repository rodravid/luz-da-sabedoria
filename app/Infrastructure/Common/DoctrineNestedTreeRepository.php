<?php

namespace App\Infrastructure\Common;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use App\Infrastructure\Common\Traits\Paginatable;

class DoctrineNestedTreeRepository extends NestedTreeRepository
{
    use Paginatable;

}