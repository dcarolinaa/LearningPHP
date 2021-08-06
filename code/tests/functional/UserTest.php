<?php

namespace Tests\functional;

use App\services\GetURL;
use GuzzleHttp\Client;
use DateTime;
use Tests\TestCase as TestsTestCase;

class UserTest extends TestsTestCase
{

    private $getURL;
    private $client;

    public function setUp() : void
    {
        $this->getURL = $this->getContainer()->get(GetURL::class);
        $this->client = new Client();
    }

    public function testCreateSuperAdmin()
    {
        $url = $this->getURL->__invoke('store', 'Users', [], false);

        $response = $this->client->request('POST', $url, [
            'form_params' => [
                'first_name' => 'Admin',
                'last_name' => 'SuperAdmin',
                'birthdate' => (new DateTime())->format('Y-m-d H:i:s'),
                'email' => 'admin@admin.com',
                'username' => 'Admin',
                'password' => 'Admin123',
                'phone_number' => '123'
            ],
            'allow_redirects' => false
        ]);
        $this->assertSame(302, $response->getStatusCode());
    }

}
