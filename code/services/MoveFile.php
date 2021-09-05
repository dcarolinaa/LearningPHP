<?php

namespace App\services;

use Exception;

class MoveFile
{
    private $homeDir;
    public function __construct(string $homeDir)
    {
        $this->homeDir = $homeDir;
    }

    public function __invoke(string $file, string $dir, string $saveAs): bool
    {
        $path = sprintf('%s/%s', $this->homeDir, $dir);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if (!file_exists($file)) {
            throw new Exception(sprintf('The file %s don\'t exists', $path));
        }

        if (!is_writable($path)) {
            throw new Exception(sprintf('The directory %s don\'t is writeble', $path));
        }

        return rename($file, sprintf('%s/%s', $path, $saveAs));
    }
}
