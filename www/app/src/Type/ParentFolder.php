<?php

declare(strict_types=1);

namespace App\Type;

class ParentFolder implements FileSystemObject
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function show(): string
    {
        $targetPath = $this->targetPath();
        if ($targetPath === ROOT_FOLDER) {
            return sprintf(
                '<a href="/">%s</a>',
                '..'
            );
        }

        return sprintf(
            '<a href="/index.php?path=%s">%s</a>',
            $targetPath,
            '..'
        );
    }

    private function targetPath(): string
    {
        $paths = explode('/', $this->path);
        array_pop($paths);

        return implode('/', $paths);
    }
}