<?php

declare(strict_types=1);

namespace App\Type;

class Image implements FileSystemObject
{
    private string $path;
    private string $fileName;

    public function __construct(string $path, string $fileName)
    {
        $this->path = $path;
        $this->fileName = $fileName;
    }

    public function show(): string
    {
        $targetPath = $this->targetPath();
        return sprintf(
            '<a target="_blank" href="%s">%s</a>',
            $targetPath . '/' . $this->fileName,
            '<div><img title="' . $this->fileName . '" src="' . $targetPath . '/' .$this->fileName . '" width="50px"></div>'
        );
    }

    private function targetPath(): string
    {
        $paths = explode(ROOT_FOLDER, $this->path);

        return $paths[1];
    }
}