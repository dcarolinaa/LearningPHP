<?php
namespace App; //lo primero en el archivo

//require('controllers/Countries.php'); //Importar clase xD
include 'controllers/Countries.php';

$controller = $_GET['controller'];
$method = $_GET['method'];

switch($controller){
    case 'countries':
        $objController = new controllers\Countries();        
        switch($method){
            case 'index':
                $objController->index();
            break;
            case 'edit':
                $objController->edit();
            break;
            case 'create':
                $objController->create();
                
        }
    break;
    case 'preferences':
    break;
    case 'users':
}
