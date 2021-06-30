<?php

namespace App\fixtures;

use App\models\Company;
use App\repositories\UsersRepository;
use App\services\CreateCompany;
use Faker\Generator as Faker;
use Tests\TestCase;

class Companies {

    public function build(Faker $faker, UsersRepository $userRepository, CreateCompany $createCompany) {
        $admin = $userRepository->getByEmail(TestCase::ADMIN_COMPANY_1);
        $now = date('Y-m-d H:i:s');
        for($i=0; $i<4; $i++) {
            $createCompany([
                'user_admin' => $admin->getId(),
                'name' => $faker->company,
                'status' => Company::STATUS_ACTIVE,
                'create_date' => $now,
                'update_date' => $now,
                'update_user' => $admin->getId()
            ]);
        }

        $createCompany([
            'user_admin' => $admin->getId(),
            'name' => 'Sushi Go!',
            'status' => Company::STATUS_ACTIVE,
            'create_date' => $now,
            'update_date' => $now,
            'update_user' => $admin->getId()
        ]);
    }   
}