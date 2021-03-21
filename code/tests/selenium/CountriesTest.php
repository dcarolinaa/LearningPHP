<?php

namespace Tests\Selenium;

use App\repositories\CountriesRepository;
use App\services\GetURL;

class CountriesTest extends SeleniumTestCase{

    private $getURL;

    public function setUp() : void{
        $this->getURL  = new GetURL();
    }
    
    public function testNew(){
        $indexURL = $this->getURL->__invoke('index', 'Countries', [], false);
        $countriesRepository = new CountriesRepository();
        $lastCountry = $countriesRepository->getLast();
        // var_dump($indexURL);
        $this->url($indexURL);

        $btn = $this->getElementById('btn-new');
        $btn->click();

        $inputName = $this->getElementById('name');
        $inputCode = $this->getElementById('code');
        $button = $this->getElementById('submit');

        $name = 'CountryName';
        $code = 'CN';

        $inputName->sendKeys($name);
        $inputCode->sendKeys($code);
        $button->click();

        $newCountry = $countriesRepository->getLast();

        // var_dump($newCountry->getId());
        // var_dump($lastCountry->getId());
        //$this->assertNotSame($newCountry->getId(), $lastCountry->getId());
        $this->assertNotSame($lastCountry ? $lastCountry->getId() : NULL, $newCountry->getId());
        // sleep(10);
    }
}