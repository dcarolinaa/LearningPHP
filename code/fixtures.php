<?php

include './vendor/autoload.php';

use App\Container;
use App\fixtures\Branches;
use App\fixtures\Companies;
use App\fixtures\Users;

$fixtures = [
    Users::class,
    Companies::class,
    Branches::class
];

$container = new Container();
include "config/services/services.php";
include "config/services/services-dev.php";
include "config/services/services-fixtures.php";

foreach($fixtures as $fixtureClass) {
    $fixture = $container->build($fixtureClass);
    $container->callMethod('build', $fixture);
}