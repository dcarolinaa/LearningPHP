<?php
include './Container.php';

$container = new App\Container();

include __DIR__ . "/config/services/services.php";

return [
    'dbname' => $container->get('dbName'),
    'user' => $container->get('dbUser'),
    'password' => $container->get('dbPassword'),
    'host' => $container->get('dbHost'),
    'driver' => 'pdo_mysql',
];
