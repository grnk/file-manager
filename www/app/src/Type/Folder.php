<?php

declare(strict_types=1);

namespace App\Type;

class Folder implements FileSystemObject
{
    private string $path;
    private string $fileName;

    public function __construct(string $path, string $fileName)
    {
        $this->path = $path;
        $this->fileName = $fileName;
    }

    public function __toString(): string
    {
        return 'folder ' . $this->path . '/' . $this->fileName . PHP_EOL;
    }

    public function show(): string
    {
        return sprintf(
            '<a href="/index.php?path=%s">%s</a>',
            $this->path . '/' . $this->fileName,
            $this->fileName
        );
    }
}