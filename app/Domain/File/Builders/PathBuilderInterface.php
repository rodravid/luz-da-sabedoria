<?php

namespace App\Domain\File\Builders;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Domain\File\Mapping\FileMapping;

interface PathBuilderInterface
{

    public function build(FileMapping $mapping, UploadedFile $uploadedFile);

}