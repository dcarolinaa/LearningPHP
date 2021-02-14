<?php
namespace App; //lo primero en el archivo
use ReflectionMethod;

//require('controllers/Countries.php'); //Importar clase xD
include 'controllers/Countries.php';
include 'controllers/Preferences.php';

$controller = $_GET['controller'];
$method = $_GET['method'];

switch($controller){
    case 'countries':
        $objController = new controllers\Countries();         
        $reflectionMethod = new ReflectionMethod(controllers\Countries::class, $method);
        $reflectionMethod->invoke($objController);                
    break;
    case 'preferences':
        $objController = new controllers\Preferences();         
        $reflectionMethod = new ReflectionMethod(controllers\Preferences::class, $method);
        $reflectionMethod->invoke($objController); 
    break;
    case 'users':
}
