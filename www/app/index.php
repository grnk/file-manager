<?php

use App\FolderIterator;

$__folderSource = 'src';
$__namespaceApplication = 'App';

define('ROOT_FOLDER', '/var/www/app');

spl_autoload_register(
    fn($className) => include_once sprintf(
        '%s/%s/%s.php',
        __DIR__,
        $__folderSource,
        str_replace(
            '\\',
            '/',
            substr($className, strlen($__namespaceApplication) + 1)
        )
    )
);

$iterator = new FolderIterator(
    isset($_GET['path']) ? $_GET['path'] : ROOT_FOLDER,
    !isset($_GET['path'])
);

include_once 'header.html';

echo '<table>';
    while ($iterator->hasNext()) {
        echo '<tr>';
            echo '<td>';
                echo $iterator->next()->show();
            echo '</td>';
        echo '</tr>';
    }
echo '</table>';

include_once 'footer.html';
