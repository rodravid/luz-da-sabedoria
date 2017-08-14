<?php

namespace App\Domain\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Domain\File\Builders\PathBuilderInterface;
use App\Domain\File\Mapping\FileMapping;

class ImageFactory
{

    public function make(FileMapping $mapping, PathBuilderInterface $builder, UploadedFile $file)
    {
        $path = $builder->build($mapping, $file);
        $dimensions = getimagesize($file);

        return Image::make([
            'caption' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'width' => $dimensions[0],
            'height' => $dimensions[1],
            'path' => $path->getPath(),
            'name' => $path->getFilename()
        ]);
    }

}