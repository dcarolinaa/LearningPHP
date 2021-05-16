<?php

include './vendor/autoload.php';

use App\Container;

$files = glob('fixtures/*.php');
$container = new Container();
include "services.php";
include "services-dev.php";
include "services-fixtures.php";

foreach($files as $file){
    $filename = pathinfo($file)['filename'];
    $className = sprintf('\\App\\fixtures\\%s', $filename);

    $fixture = $container->build($className);
    $container->callMethod('build', $fixture);
}