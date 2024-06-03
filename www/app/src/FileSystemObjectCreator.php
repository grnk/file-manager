<?php

declare(strict_types=1);

namespace App;

use App\Type\FileSystemObject;
use App\Type\Folder;
use App\Type\Image;

class FileSystemObjectCreator
{
    private string $path;
    private string $fileName;

    public function __construct(string $path, string $fileName)
    {
        $this->path = $path;
        $this->fileName = $fileName;
    }

    public function create(): FileSystemObject
    {
        return is_dir(sprintf('%s/%s', $this->path, $this->fileName))
            ? new Folder($this->path, $this->fileName)
            : new Image($this->path, $this->fileName);
    }
}
