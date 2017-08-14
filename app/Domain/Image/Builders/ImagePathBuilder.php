<?php

namespace App\Domain\Image\Builders;

use App\Domain\File\Builders\PathBuilder;
use App\Domain\File\Mapping\FileMapping;
use Illuminate\Http\UploadedFile;

class ImagePathBuilder extends PathBuilder
{
    public function buildFileName(FileMapping $mapping, UploadedFile $uploadedFile)
    {
        $extension = $uploadedFile->getClientOriginalExtension();
        $dimensions = getimagesize($uploadedFile);
        $width = $dimensions[0];
        $height = $dimensions[1];
        return "{$mapping->getIdentifier()}-{$width}x{$height}.{$extension}";
    }
}