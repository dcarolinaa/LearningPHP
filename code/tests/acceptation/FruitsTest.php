<?php
namespace Tests\acceptation;

class FruitsTest extends SeleniumTestCase
{

    public function testHello(): void
    {
        $webDriver = $this->getWebDriver();
        $url = $this->getUrl('/js/frutitas');
        $webDriver->get($url);

        $this->fillForm('Abuacatito','abuacatito');
        $this->fillForm('Frambuesas','frambuesa');
        $this->fillForm('Mandarina','mangarina');
        $this->fillForm('Fresa','fresa');
        $this->fillForm('Mango','mango');

        $this->getElementByCss('.delete-image')->click();
        sleep(40);

    }
    
    private function fillForm($text, $image){
        $inputText = $this->getElementById('my-little-text');
        $inputText->sendKeys($text);

        $inputFile = $this->getElementById('file');
        $this->sendFile($inputFile, sprintf('images/%s.jpg', $image));
        
        $buttonAdd = $this->getElementById('btn-weird');
        $buttonAdd->click();
    }
}