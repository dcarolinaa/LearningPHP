<?php

namespace Tests\functional;

use App\repositories\CountriesRepository;
use App\services\GetURL;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class CountryTest extends TestCase{
    private $getURL;
    private $countriesRepository;
    private $client;

    public function setUp() : void{
        $this->getURL = new GetURL;
        $this->countriesRepository = new CountriesRepository();
        $this->client = new Client();
    }

    public function pages  (){
        return [
            ['index'],
            ['edit'],
            ['create']
        ];
    }

    /**
     * @dataProvider pages
     */
    public function testPages($page){
        $url = $this->getURL->__invoke($page, 'Countries', [], false);        
        $response = $this->client->request('GET', $url);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStore(){
        $url = $this->getURL->__invoke('store', 'Countries', [], false);        
        $response = $this->client->request('POST', $url, [
            'form_params' => [
                'name' => 'country functional',
                'code' => 'cf'                
            ],
            'allow_redirects' => false
        ]);

        $this->assertStatusHeader($response);
    }

    public function testUpdate(){        
        $newName = 'country functional edited';
        $newCode = 'CFE';

		$country = $this->countriesRepository->getLast();
		$editURL = $this->getURL->__invoke('update','Countries',[], false);
		
        $response = $this->client->request('POST', $editURL, [
            'form_params' => [
                'name' => $newName,
                'code' => $newCode,
                'id' => $country->getId()              
            ],
            'allow_redirects' => false
        ]);
        
        $editedCountry = $this->countriesRepository->getById($country->getId());

        $this->assertStatusHeader($response);
        $this->assertSame($editedCountry->getName(), $newName);
        $this->assertSame($editedCountry->getCode(), $newCode);
    }

    public function testDelete(){        
        $country = $this->countriesRepository->getLast();
        //delete should be by DELETE method        
		$deleteURL = $this->getURL->__invoke('delete','Countries',['id' => $country->getId()],false);
        $response = $this->client->request('GET', $deleteURL, [            
            'allow_redirects' => false
        ]);

		$this->assertStatusHeader($response);
        $dbCountry = $this->countriesRepository->getById($country->getId());
        $this->assertNull($dbCountry);
    }

    private function assertStatusHeader($response){			
		$indexURL = $this->getURL->__invoke('index','Countries');
		$headerLocation = $response->getHeader('Location');
		$this->assertCount(1, $headerLocation);
		$this->assertSame($indexURL, $headerLocation[0]);
		$this->assertSame(302, $response->getStatusCode());	
	}
}