<?php

declare(strict_types=1);

namespace App;

use App\Type\FileSystemObject;
use App\Type\ParentFolder;

class FolderIterator
{
    private array $items = [];
    private bool $firstEnter = true;
    private string $path;
    private bool $isRootFolder;

    public function __construct(string $path, bool $isRootFolder = false) {
        $this->path = $path;
        $this->isRootFolder = $isRootFolder;
        $this->items = $this->all();
    }

    public function hasNext(): bool
    {
        if (!$this->isRootFolder && $this->firstEnter) {
            return true;
        }

        return current($this->items) !== false;
    }

    public function next(): FileSystemObject
    {
        if (!$this->isRootFolder && $this->firstEnter) {
            $this->firstEnter = false;
            return new ParentFolder($this->path);
        }

        $item = current($this->items);
        next($this->items);

        return (new FileSystemObjectCreator($this->path, $item))->create();
    }

    private function all(): array
    {
        return
            array_filter(
                scandir($this->path),
                fn(string $item) => !str_starts_with($item, '.')
                    && (
                        str_ends_with($item, '.bmp')
                        || str_ends_with($item, '.gif')
                        || str_ends_with($item, '.png')
                        || str_ends_with($item, '.img')
                        || str_ends_with($item, '.jpeg')
                        || is_dir($this->path . '/' . $item)
                    )
            );
    }
}
