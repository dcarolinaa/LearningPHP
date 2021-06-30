<?php

include './vendor/autoload.php';

use App\Container;
use App\fixtures\Companies;
use App\fixtures\Users;

$fixtures = [
//    Users::class,    
    Companies::class
];

$container = new Container();
include "services.php";
include "services-dev.php";
include "services-fixtures.php";

foreach($fixtures as $fixtureClass) {
    $fixture = $container->build($fixtureClass);
    $container->callMethod('build', $fixture);
}