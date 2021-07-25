<?php
namespace Tests\Selenium;

class HelloTest extends SeleniumTestCase {

    public function testHello(): void 
    {
        $webDriver = $this->getWebDriver();        
        $url = $this->getBaseUrl();
        $webDriver->get($url);        
        $element = $this->getElementByCss('h5.card-title');
        $expectedTitle = 'Login';
        $this->assertSame($expectedTitle, $element->getText());
    }

}
