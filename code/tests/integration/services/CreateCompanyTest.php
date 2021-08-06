<?php

namespace Tests\integration\services;

use App\models\Company;
use App\repositories\UsersRepository;
use App\services\SaveCompany;
use \Faker\Generator as Faker;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{

    public function testCreateCompany()
    {
        $saveCompany = $this->getContainer()->get(SaveCompany::class);
        $faker = $this->getContainer()->get(Faker::class);
        $userRepository = $this->getContainer()->get(UsersRepository::class);
        $admin = $userRepository->getByEmail(self::ADMIN_COMPANY_1);
        $now = date('Y-m-d H:i:s');

        $company = $saveCompany([
            'user_admin' => $admin->getId(),
            'name' => $faker->company,
            'status' => Company::STATUS_ACTIVE,
            'update_user' => $admin->getId()
        ]);

        $this->assertNotNull($company->getId());
    }
}
