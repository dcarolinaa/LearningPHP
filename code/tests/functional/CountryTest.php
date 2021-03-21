<?php

namespace Tests\functional;

use App\services\GetURL;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class CountryTest extends TestCase{

    public function testIndex(){
        $getURL = new GetURL();
        $url = $getURL('index','Countries', [], false);
        $client = new Client();
        $response = $client->request('GET', $url);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testStore(){
        $getURL = new GetURL();
        $url = $getURL('store','Countries', [], false);
        $client = new Client();
        $response = $client->request('POST', $url, [
            'form_params' => [
                'name' => 'country functional',
                'code' => 'cf',
                'otra' => 'otra variable'
            ]
        ]);
        
        // var_dump($response->getHeaders());

        //var_dump($response->getBody()->__toString());
        $this->assertSame(200, $response->getStatusCode());
    }
}