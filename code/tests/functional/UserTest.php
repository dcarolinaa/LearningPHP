<?php

namespace Tests\functional;

use PHPUnit\Framework\TestCase;
use App\services\GetURL;
use GuzzleHttp\Client;
use DateTime;

class UserTest extends TestCase{

    private $getURL;
    private $client;

    public function setUp() : void{    
        $this->getURL = new GetURL;
        $this->client = new Client();
    }

    // public function testPage(){
    //     //http://localhost:8081/?controller=Users&method=signUp
    // }

    public function testCreateSuperAdmin(){
        //die('kesatapasanda');
        //'first_name','last_name','birthdate','email','username','password'        
        $url = $this->getURL->__invoke('store', 'Users', [], false);  
        
        // var_dump($url);
        // die();

        $response = $this->client->request('POST', $url, [
            'form_params' => [
                'first_name' => 'Admin',
                'last_name' => 'SuperAdmin',
                'birthdate' => (new DateTime())->format('Y-m-d H:i:s'),
                'email' => 'admin@admin.com',
                'username' => 'Admin',
                'password' => 'Admin123'
            ],
            'allow_redirects' => false
        ]);

        $this->assertSame(302, $response->getStatusCode());	
    }

    //Evaluar el servicio ... 

}