<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\models\Country;
use App\services\SaveEntity;
use App\services\DeleteEntity;
use App\repositories\CountriesRepository;
use App\services\GetDBConnection;
use PDO;

final class CountryTest extends TestCase{
    private $saveEntity;
    private $countriesRepository;
    private $deleteEntity;
    private $getDBConnection;

    public function setUp(): void{
        //parent::setUp(); //invoca métodos de la clase que se herede
        $this->saveEntity = new SaveEntity();
        $this->countriesRepository = new CountriesRepository();
        $this->deleteEntity = new DeleteEntity();
        $this->getDBConnection = new GetDBConnection();
    }

    public function testSAveACountry(){  
        //var_dump('primero');      
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
        
        $this->assertSameDBCountry($country);

        return $country;        
    }

    /**
     * @depends testSAveACountry
     */
    public function testUpdateCountry($country){
        $country->setName(utf8_decode("MÉXICO"));
        $country->setCode("MEX");
        
        $this->saveEntity->__invoke($country);
        
        $this->assertSameDBCountry($country);
        //var_dump('segunda', $country->getId());
        return $country;
    }

    /**
     * @depends testUpdateCountry
     */
    public function testDeleteCountry($country){
        $dbCountry = $this->countriesRepository->getById($country->getId());
        $this->assertNotNull($dbCountry);        
        
        $this->deleteEntity->__invoke($country);

        $dbCountry = $this->countriesRepository->getById($country->getId());
        $this->assertNull($dbCountry);   
    }

    public function testGetCountries(){
        $countiries = $this->countriesRepository->getAll();
        $sql = sprintf('SELECT count(id) as total from %s',Country::getTable());
        $conection = $this->getDBConnection->__invoke();

        $statement = $conection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->assertSame((int)$result['total'], count($countiries));

    }

    private function assertSameDBCountry($country){
        $dbCountry = $this->countriesRepository->getById($country->getId());
        $this->assertSame($country->getName(), $dbCountry->getName());
        $this->assertSame($country->getCode(), $dbCountry->getCode());
        $this->assertSame($country->getId(), $dbCountry->getId());
    }

}