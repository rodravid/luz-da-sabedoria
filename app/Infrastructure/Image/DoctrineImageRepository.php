<?php

namespace App\Infrastructure\Image;

use App\Domain\Image\Image;
use App\Domain\Image\ImageRepository;
use App\Infrastructure\Common\DoctrineBaseRepository;

class DoctrineImageRepository extends DoctrineBaseRepository implements ImageRepository
{

    public function save($image)
    {
        if (empty($image->getName())) {
            $image->generateUniqueName();
        }

        parent::save($image);
        return $image;
    }

}