<?php
namespace App; //lo primero en el archivo
use ReflectionMethod;
use ReflectionClass;

//require('controllers/Countries.php'); //Importar clase xD
include 'controllers/Countries.php';
include 'controllers/Preferences.php';
include 'controllers/Users.php';

$controller = $_GET['controller'];
$method = $_GET['method'];

$controllerClass = sprintf('App\\controllers\\%s', ucwords($controller));
//var_dump($controllerClass);

$reflectionClass = new ReflectionClass($controllerClass);
$objController = $reflectionClass->newInstance();

$reflectionMethod = new ReflectionMethod($controllerClass, $method);
$reflectionMethod->invoke($objController);
