<?php

namespace App\fixtures;

use App\models\Company;
use App\repositories\UsersRepository;
use App\services\SaveCompany;
use Faker\Generator as Faker;
use Tests\TestCase;

class Companies {

    public function build(Faker $faker, UsersRepository $userRepository, SaveCompany $saveCompany) {
        $admin = $userRepository->getByEmail(TestCase::ADMIN_COMPANY_1);
        $now = date('Y-m-d H:i:s');

        $saveCompany([
            'user_admin' => $admin->getId(),
            'name' => 'Sushi Go!',
            'status' => Company::STATUS_ACTIVE,
            'create_date' => $now,
            'update_date' => $now,
            'update_user' => $admin->getId()
        ]);

        for($i=0; $i<4; $i++) {
            $saveCompany([
                'user_admin' => $admin->getId(),
                'name' => $faker->company,
                'status' => Company::STATUS_ACTIVE,
                'create_date' => $now,
                'update_date' => $now,
                'update_user' => $admin->getId()
            ]);
        }

       
    }   
}