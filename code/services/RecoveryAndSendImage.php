<?php

namespace App\services;

use DateInterval;
use DateTime;
use Exception;
use Imagine\Gd\Imagine;

class RecoveryAndSendImage
{
    private $homeDir;
    public function __construct(string $uploadDir, string $homeDir)
    {
        $this->uploadDir = $uploadDir;
        $this->homeDir = $homeDir;
    }

    public function __invoke(string $originalFile, int $width, string $extension = 'jpg', int $quality = 90)
    {
        $this->sendCacheHeaders();
        $file = sprintf('%s/%s', $this->homeDir, $originalFile);
        if (!file_exists($file)) {
            throw new Exception(sprintf('The file "%s" don\'t exists', $file));
        }

        $saveAs = $this->getCachePath($originalFile, $width, $extension);
        if (file_exists($saveAs)) {
            $this->sendImagenFromCache($saveAs);
            die;
        }

        $this->createCachePathIfItDontExists($saveAs);
        $this->createAndShowCacheImage($file, $width, $quality, $saveAs);
        die;
    }

    private function createAndShowCacheImage($file, $width, $quality, $saveAs)
    {
        $imagine = new Imagine();
        $image = $imagine->open($file);
        $image->resize($image->getsize()->widen($width));
        $image->save($saveAs, ['jpeg_quality' => $quality]);
        $image->show('jpg', ['jpeg_quality' => $quality]);
    }

    private function createCachePathIfItDontExists(string $saveAs)
    {
        $cachePath = dirname($saveAs);
        if (!file_exists($cachePath)) {
            mkdir($cachePath, 0777, true);
        }
    }

    private function sendImagenFromCache($saveAs)
    {
        header('Content-Type: image/jpeg');
        echo file_get_contents($saveAs);
    }

    private function getCachePath(string $originalFile, int $width, string $extension)
    {
        $cachePathTemp = pathinfo(
            sprintf(
                '%s/cache/%s',
                $this->homeDir,
                $originalFile
            )
        );

        return sprintf(
            '%s/%s/%s_w%s.%s',
            $cachePathTemp['dirname'],
            $cachePathTemp['filename'],
            $cachePathTemp['filename'],
            $width,
            $extension
        );
    }

    private function sendCacheHeaders()
    {
        header('Pragma: public');
        $days = 86400 * 30;
        header('Cache-Control: max-age=' . $days);

        $dateTime = new DateTime();
        $dateTime->add(new DateInterval('P3M'));
        header('Expires: ' . $dateTime->format('D, d M Y H:i:s \G\M\T'));
    }
}
