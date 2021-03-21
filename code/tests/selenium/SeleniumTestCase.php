<?php

namespace Tests\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class SeleniumTestCase extends TestCase {

    protected $webDriver;

    protected function getWebDriver(){
        if (null === $this->webDriver){
            $serverUrl = "http://selenium-hub:4444";
            $this->webDriver = RemoteWebDriver::create(
                $serverUrl,
                DesiredCapabilities::chrome()
            );
        }

        return $this->webDriver;
    }

    protected function url($url) {
        $this->getWebDriver()->get($url);
    }

    protected function getElementById($id){
        return $this->getWebDriver()->findElement(WebDriverBy::id($id));
    }

    protected function tearDown(): void{
        if(null !== $this->webDriver){
            $this->webDriver->quit();
            $this->webDriver = null;
        }
    }

}