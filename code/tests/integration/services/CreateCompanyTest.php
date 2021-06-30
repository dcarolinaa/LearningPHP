<?php

namespace Tests\integration\services;

use App\models\Company;
use App\repositories\UsersRepository;
use App\services\CreateCompany;
use \Faker\Generator as Faker;
use Tests\TestCase;

class CreateCompanyTest extends TestCase{

    public function testCreateCompany()
    {
        $createCompany = $this->getContainer()->get(CreateCompany::class);
        $faker = $this->getContainer()->get(Faker::class);
        $userRepository = $this->getContainer()->get(UsersRepository::class);
        $admin = $userRepository->getByEmail(self::ADMIN_COMPANY_1);                
        $now = date('Y-m-d H:i:s');

        $company = $createCompany([
            'user_admin' => $admin->getId(),
            'name' => $faker->company,
            'status' => Company::STATUS_ACTIVE,
            'create_date' => $now,
            'update_date' => $now,
            'update_user' => $admin->getId()
        ]);
        
        $this->assertNotNull($company->getId());
    }
}