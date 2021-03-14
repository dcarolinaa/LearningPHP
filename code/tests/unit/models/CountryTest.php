<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\models\Country;
use App\services\SaveEntity;
use App\Config;
use PDO;

final class CountryTest extends TestCase{
    private $saveEntity;

    private static function getConection(){
        $conection = new PDO(
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

    public function setUp(): void{
        //parent::setUp(); //invoca métodos de la clase que se herede
        $this->saveEntity = new SaveEntity();
    }

    public function testSAveACountry(){  
        var_dump('primero');      
        $name = utf8_decode('México');
        $code = 'MX';
    
        $country = new Country();
        $country->setName($name);
        $country->setCode($code);
        $this->assertNull($country->getId());
                
        $this->saveEntity->__invoke($country);

        $this->assertSame($name, $country->getName());
        $this->assertSame($code, $country->getCode());
        $this->assertNotNull($country->getId());
        

        $sql = 'SELECT * FROM countries where id = :id';
        $statement = $this->getConection()->prepare($sql);
        $statement->execute([
            ":id" => $country->getId()
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->assertSame($name, $result['name']);
        $this->assertSame($code, $result['code']);
        $this->assertSame($country->getId(), $result['id']);

        return $country;        
    }

    /**
     * @depends testSAveACountry
     */
    public function testUpdateCountry($country){
        $name = utf8_decode("MÉXICO");
        $code = "MEX";
        $country->setName($name);
        $country->setCode($code);
        
        $this->saveEntity->__invoke($country);
        
        $sql = 'SELECT * FROM countries where id = :id';
        $statement = $this->getConection()->prepare($sql);
        $statement->execute([
            ":id" => $country->getId()
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->assertSame($country->getName(), $result['name']);
        $this->assertSame($country->getCode(), $result['code']);
        $this->assertSame($country->getId(), $result['id']);

        var_dump('segunda', $country->getId());
    }
}