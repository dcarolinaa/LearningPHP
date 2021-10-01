<?php

namespace Tests\integration\services;

use App\services\DeleteDirectory;
use Tests\TestCase;

class DeleteFileTest extends TestCase
{

    private function createDirectory($path)
    {
        mkdir($path, 0777, true);
        touch(sprintf('%s/file1.txt', $path));
        touch(sprintf('%s/file2.txt', $path));
        touch(sprintf('%s/file3.txt', $path));
    }

    public function testDeleteFile()
    {
        $tmpDir = $this->getContainer()->get('tempDirectory');
        $testPath = sprintf('%s/dir1', $tmpDir);

        $directories = [
            $testPath,
            sprintf('%s/dir1/subdir1', $tmpDir),
            sprintf('%s/dir1/subdir2', $tmpDir),
            sprintf('%s/dir1/subdir1/dir2', $tmpDir),
        ];

        foreach ($directories as $directory) {
            $this->createDirectory($directory);
        }

        $this->assertFileExists(sprintf('%s/dir1/subdir1/dir2/file3.txt', $tmpDir));

        $deleteDirectory = $this->getContainer()->get(DeleteDirectory::class);
        $deleteDirectory($testPath);

        $this->assertFileDoesNotExist($testPath);

    }
}
