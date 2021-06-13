<?php

namespace App\fixtures;

use App\models\User;
use App\services\AddProfileToUser;
use Faker\Generator as Faker;

use App\services\CreateUser;

class Users{

    public function build(CreateUser $createUser, AddProfileToUser $addProfileToUser, Faker $faker){       
        for($i=0; $i<100; $i++){
            $user = [                
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'birthdate' => $faker->date('Y-m-d'),
                    'email' => $faker->email,
                    'username' => $faker->userName,
                    'password' => 'password'
            ];
            $createUser($user);
        }

        $user = $createUser(
            [                
                'first_name' => 'Super Admin',
                'last_name' => '',
                'birthdate' => $faker->date('Y-m-d'),
                'email' => 'admin@romitogo.com',
                'username' => 'romitogo',
                'password' => 'password'
        ]);

        $addProfileToUser($user, User::ROLE_SUPERADMIN);

        $user = $createUser(
            [                
                'first_name' => 'SushiGo',
                'last_name' => '',
                'birthdate' => $faker->date('Y-m-d'),
                'email' => 'admin@sushigo.com',
                'username' => 'sushigo',
                'password' => 'password'
        ]);

        $addProfileToUser($user, User::ROLE_ADMIN);

    }
}