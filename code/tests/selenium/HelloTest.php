<?php
namespace Tests\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;
use \Faker\Factory as FakerFactory;
use \App\Config;
use PDO;

class HelloTest extends TestCase{
    private $webDriver = null;

    private static function getConection(){
        $conection = new \PDO(
            sprintf(
                'mysql:host=%s:%s;dbname=%s',
                Config::DB_HOST,
                Config::DB_PORT,
                Config::DB_NAME,
                
            ), Config::DB_USER,
            Config::DB_PASSWORD
        );

        return $conection;
    }

    public function getWebDriver(){
        if (null === $this->webDriver){
            $serverUrl = "http://selenium-hub:4444";
            $this->webDriver = RemoteWebDriver::create(
                $serverUrl,
                DesiredCapabilities::chrome()
            );
        }

        return $this->webDriver;
    }

    public function testHello(){
        //var_dump("ok");
        $webDriver = $this->getWebDriver();    
        $url = "http://www";
        $webDriver->get($url);

        $faker = FakerFactory::create('es_ES');
        $btnNew = $webDriver->findElement(WebDriverBy::id('btn-new'));
        $btnNew->click();

        $shortname = $faker->word;
        $inputShortName = $webDriver->findElement(WebDriverBy::id('shortName'));
        $inputShortName->sendKeys($shortname);

        $name = $faker->words(3,true);
        $inputName = $webDriver->findElement(WebDriverBy::id('name'));
        $inputName->sendKeys($name);

        $btnCreate = $webDriver->findElement(WebDriverBy::cssSelector('button[type="submit"]'));
        $btnCreate->click();

        $db = $this->getConection();
        $sql = 'SELECT * FROM preferences ORDER BY id DESC LIMIT 1';
        $statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);        
        $this->assertSame($shortname, $result['shortname']);
        $this->assertSame($name, $result['name']);

        // var_dump($result);
        $idPreference = sprintf('preference_%s',$result['id']);
        $trPreference =  $webDriver->findElement((WebDriverBy::id($idPreference)));
        $this->assertNotNull($trPreference);
        
        sleep(10);        
    }

    protected function tearDown(): void{
        if(null !== $this->webDriver){
            $this->webDriver->quit();
            $this->webDriver = null;
        }
    }
}