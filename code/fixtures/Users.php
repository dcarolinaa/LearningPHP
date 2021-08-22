<?php

namespace App\fixtures;

use App\models\User;
use App\services\AddProfileToUser;
use Faker\Generator as Faker;

use App\services\CreateUser;
use Tests\TestCase;

class Users
{

    public function build(
        CreateUser $createUser,
        AddProfileToUser $addProfileToUser,
        Faker $faker
    ) {
        $user = $createUser(
            [
                'first_name' => 'Super Admin',
                'last_name' => '',
                'birthdate' => $faker->date('Y-m-d'),
                'email' => 'admin@romitogo.com',
                'phone_number' => $faker->randomNumber(6),
                'username' => 'romitogo',
                'password' => TestCase::DEFAULT_PASSWORD
            ]);

        $addProfileToUser($user, User::ROLE_SUPERADMIN);

        $user = $createUser(
            [
                'first_name' => 'SushiGo',
                'last_name' => '',
                'birthdate' => $faker->date('Y-m-d'),
                'email' => 'admin@sushigo.com',
                'phone_number' => $faker->randomNumber(6),
                'username' => 'sushigo',
                'password' => TestCase::DEFAULT_PASSWORD
            ]);

        $addProfileToUser($user, User::ROLE_ADMIN);

        $user = $createUser(
            [
                'first_name' => 'SushiGoDeliver',
                'last_name' => 'Test',
                'birthdate' => $faker->date('Y-m-d'),
                'email' => 'delivertest@sushigo.com',
                'phone_number' => $faker->randomNumber(6),
                'username' => 'delivertest',
                'password' => TestCase::DEFAULT_PASSWORD
            ]);

        for ($i = 0; $i < 100; $i++) {
            $user = [
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'birthdate' => $faker->date('Y-m-d'),
                    'email' => $faker->email,
                    'phone_number' => $faker->randomNumber(6),
                    'username' => $faker->userName,
                    'password' => TestCase::DEFAULT_PASSWORD
            ];
            $createUser($user);
        }

    }
}
