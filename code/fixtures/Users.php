<?php

namespace App\fixtures;
use Faker\Generator as Faker;

use App\services\CreateUser;

class Users{

    public function build(CreateUser $createUser, Faker $faker){       
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
    }
}