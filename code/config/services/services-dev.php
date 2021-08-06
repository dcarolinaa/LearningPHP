<?php
use \Faker\Factory as Fakerfactory;
use \Faker\Generator as Faker;

$container->add(Faker::class, function () {
    return FakerFactory::create();
});
