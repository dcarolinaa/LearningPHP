<?php

namespace Tests\acceptation;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\LocalFileDetector;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Tests\TestCase;

class SeleniumTestCase extends TestCase
{

    protected $webDriver;


    protected function getWebDriver(): RemoteWebDriver
    {
        if (null === $this->webDriver) {
            $serverUrl = $this->getContainer()->get('seleniumHub');
            $this->webDriver = RemoteWebDriver::create(
                $serverUrl,
                DesiredCapabilities::chrome()
            );
        }

        return $this->webDriver;
    }

    protected function url($url)
    {
        $this->getWebDriver()->get($url);
    }

    protected function getElementById($id)
    {
        return $this->getWebDriver()->findElement(WebDriverBy::id($id));
    }

    public function getElementByCss($cssSelector) : RemoteWebElement
    {
        return $this->getWebDriver()->findElement(
            WebDriverBy::cssSelector($cssSelector)
        );
    }

    protected function tearDown(): void
    {
        if (null !== $this->webDriver) {
            $this->webDriver->quit();
            $this->webDriver = null;
        }
    }

    public function sendFile($inputFile, $filePath){
        $fileDetector = new LocalFileDetector();
        $inputFile->setFileDetector($fileDetector);
        $inputFile->sendKeys(sprintf('%s%s','/var/www/tests/fixtures/', $filePath));
    }

}
