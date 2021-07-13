<?php

namespace App; //lo primero en el archivo
session_start();

include './vendor/autoload.php';

//Index es el punto de acceso y la siguiente funcion crea los includes "dinamicos"
/*spl_autoload_register(function($className){
    include __DIR__.str_replace('\\','/',substr($className,3)).'.php';
});
*/
//require('controllers/Countries.php'); //Importar clase xD
/*
include 'controllers/Controller.php';
include 'controllers/Countries.php';
include 'controllers/Preferences.php';
include 'controllers/Users.php';
include 'models/Preference.php';
include 'Config.php';
*/

use Exception;
use ReflectionMethod;
use ReflectionClass;

$defaultController = 'Preferences';
$defaultMethod = 'index';

$container = new Container();

include "services.php";

$controller = isset($_GET['controller']) ? $_GET['controller'] : $defaultController;
$method = isset($_GET['method']) ? $_GET['method'] : $defaultMethod;
//isset ¿está definido? xD

$controllerClass = sprintf('App\\controllers\\%s', ucwords($controller));
//var_dump($controllerClass);
if(!class_exists($controllerClass) || !method_exists($controllerClass, $method)){
    header("HTTP/1.1 404 Not Found");
    die;
}

$container->add('method', function() use ($method) {
    return $method;
});

$reflectionClass = new ReflectionClass($controllerClass);
$controllerCostructor = $reflectionClass->getConstructor();
$parameters = $controllerCostructor->getParameters();
$params = [];
foreach($parameters as $parameter){
    try {
        $name = $parameter->getName();
        $params[] = $container->get($name);
    } catch(Exception $ex) {
        $classNameParameter = $parameter->getType()->getName();        
        $params[] = $container->get($classNameParameter);
    }
}

$objController = $reflectionClass->newInstanceArgs($params);
$objController->setContainer($container);

$reflectionMethod = new ReflectionMethod($controllerClass, $method);

$parameters = $reflectionMethod->getParameters();
$params = [];
foreach($parameters as $parameter){
    try {
        $name = $parameter->getName();
        $params[] = $container->get($name);
    } catch(Exception $ex) {
        $classNameParameter = $parameter->getType()->getName();        
        $params[] = $container->get($classNameParameter);
    }
}


$reflectionMethod->invokeArgs($objController, $params);

$objController->renderTemplate();