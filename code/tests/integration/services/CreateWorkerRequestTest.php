<?php

namespace Tests\integration\services;

use App\services\CreateWorkerRequest;
use \Faker\Generator as Faker;
use Tests\TestCase;

class CreateWorkerRequestTest extends TestCase{
    
    public function testCreateWorkerRequest(){
        $faker = $this->getContainer()->get(Faker::class);
        $email = $faker->email;

        $createWorkerRequestService = $this->getContainer()->get(CreateWorkerRequest::class);

        $worker_request = $createWorkerRequestService([
            'id_company' => 1,
            'email' => $email,            
            'create_user' => 1, 
        ]);
        
    }

}