<?php

namespace Tests\functional;

use App\repositories\CountriesRepository;
use App\services\GetURL;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class CountryTest extends TestCase{

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
        $getURL = new GetURL();
            $url = $getURL($page,'Countries', [], false);
            $client = new Client();
            $response = $client->request('GET', $url);
            $this->assertSame(200, $response->getStatusCode());
    }

    // public function testIndex(){
    //     $getURL = new GetURL();
    //     $url = $getURL('index','Countries', [], false);
    //     $client = new Client();
    //     $response = $client->request('GET', $url);
    //     $this->assertSame(200, $response->getStatusCode());
    // }

    public function testStore(){
        $getURL = new GetURL();
        $url = $getURL('store','Countries', [], false);
        $indexURL = $getURL('index','Countries');
        $client = new Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'name' => 'country functional',
                'code' => 'cf'                
            ],
            'allow_redirects' => false
        ]);
        // $this->assertSame()
        // var_dump($response->getHeaders());
        // echo $response->getHeader('Location');
        $headerLocation = $response->getHeader('Location');
        $this->assertCount(1, $headerLocation);
        $this->assertSame($indexURL, $headerLocation[0]);

        //var_dump($response->getBody()->__toString());
        $this->assertSame(302, $response->getStatusCode());
    }

    public function testUpdate(){
        $getURL = new GetURL();
        $countryRepository = new CountriesRepository();
        $indexURL = $getURL('index','Countries');
        $client = new Client();
        $newName = 'country functional edited';
        $newCode = 'CFE';

        //update should be by PUT method
        $country = $countryRepository->getLast();
        $editURL = $getURL('update','Countries',[], false);
        $response = $client->request('POST', $editURL, [
            'form_params' => [
                'name' => $newName,
                'code' => $newCode,
                'id' => $country->getId()              
            ],
            'allow_redirects' => false
        ]);
        // var_dump($response->getBody()->__toString());

        $headerLocation = $response->getHeader('Location');
        $this->assertCount(1, $headerLocation);
        $this->assertSame($indexURL, $headerLocation[0]);
        $this->assertSame(302, $response->getStatusCode());

        $editedCountry = $countryRepository->getById($country->getId());

    }

    public function testDelete(){
        $getURL = new GetURL();
        $countryRepository = new CountriesRepository();        
        $client = new Client();

        $country = $countryRepository->getLast();
        //delete should be by DELETE method
        $deleteURL = $getURL('delete','Countries',['id' => $country->getId()],false);
        $response = $client->request('GET', $deleteURL, [            
            'allow_redirects' => false
        ]);

        $indexURL = $getURL('index','Countries');
        $headerLocation = $response->getHeader('Location');
        $this->assertCount(1, $headerLocation);
        $this->assertSame($indexURL, $headerLocation[0]);
        $this->assertSame(302, $response->getStatusCode());

        $dbCountry = $countryRepository->getById($country->getId());
        $this->assertNull($dbCountry);

    }
}