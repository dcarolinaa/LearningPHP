<?php

namespace Tests\integration\services;

use App\models\User;
use App\services\CreateWorkerRequest;
use App\services\DeleteEntity;
use \Faker\Generator as Faker;
use Tests\TestCase;

class CreateWorkerRequestTest extends TestCase{
    
    public function testCreateWorkerRequest(): void 
    {
        $faker = $this->getContainer()->get(Faker::class);
        $email = $faker->email;

        $createWorkerRequestService = $this->getContainer()->get(CreateWorkerRequest::class);
        $deleteEntityService = $this->getContainer()->get(DeleteEntity::class);

        $worker_request = $createWorkerRequestService([
            'id_company' => TestCase::COMPANY_1_ID,
            'email' => $email,            
            'create_user' => TestCase::ADMIN_COMPANY_1_ID, 
            'rol' => User::ROLE_BRANCADMIN
        ]);

        $this->assertNotNull($worker_request->getId());

        $deleteEntityService($worker_request);
        
    }

}
