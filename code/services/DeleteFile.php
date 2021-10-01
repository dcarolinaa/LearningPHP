<?php

namespace App\services;

class DeleteFile
{
    public function __invoke($file)
    {
        if (!file_exists($file)) {
            return;
        }

        unlink($file);
    }
}
