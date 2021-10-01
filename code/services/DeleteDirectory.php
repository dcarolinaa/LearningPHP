<?php

namespace App\services;

class DeleteDirectory
{
    public function __invoke($path)
    {
        if (!file_exists($path)) {
            return;
        }

        foreach (scandir($path) as $file) {
            $fullFileName = sprintf('%s/%s', $path, $file);

            if (is_dir($fullFileName) && $file != '.' && $file != '..') {
                $this->__invoke($fullFileName);
            } else {
                if (is_file($fullFileName)) {
                    unlink($fullFileName);
                }
            }
        }

        rmdir($path);
    }
}
