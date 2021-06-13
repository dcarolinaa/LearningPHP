<?php

namespace Tests\integration\services;

use App\services\CreateUser;
use App\models\User;
use App\services\AddProfileToUser;
use App\services\UserHasProfile;
use \Faker\Generator as Faker;
use Tests\TestCase;

class AddProfileToUserTest extends TestCase{

    public function testAddProfileToUser(){
        $faker = $this->getContainer()->get(Faker::class);        
        $birthdate = $faker->dateTimeBetween('-30 days', '+30 days');

        $createUserService = $this->getContainer()->get(CreateUser::class);        
        $addProfileToUser = $this->getContainer()->get(AddProfileToUser::class);
        $userHasProfile = $this->getContainer()->get(UserHasProfile::class);
        $email = $faker->email;

        $user = $createUserService([
            'first_name' => 'Admin2',
            'last_name' => 'SuperAdmin2',
            'birthdate' => $birthdate->format('Y-m-d'),
            'email' =>  $email,
            'username' => 'Admin2',
            'password' => 'Admin123'
        ]);
        
        $this->assertFalse($userHasProfile(User::ROLE_ADMIN, $user->getId()));
        $addProfileToUser($user, User::ROLE_ADMIN);
        $this->assertTrue($userHasProfile(User::ROLE_ADMIN, $user->getId()));
    }
}