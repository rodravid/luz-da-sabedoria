<?php

namespace App\Domain\File\Factories;

use App\Domain\File\Builders\PathBuilder;
use App\Domain\File\File;
use App\Domain\File\Mapping\FileMapping;
use Illuminate\Http\UploadedFile;

abstract class FileFactory
{
    public function make(FileMapping $mapping, PathBuilder $builder, UploadedFile $file) {
        
        $builder->build($mapping, $file);

        return File::make([
            'caption' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'path' => $builder->getFolderPath(),
            'name' => $builder->getFilename()
        ]);
    }
}