<?php
namespace App\services;

class GetURL{

    public function __invoke($method, $controller, $data = [])
    {
        if(true === is_object($controller)){
            $arrControllerParts = explode('\\',get_class($controller));
            $controller = $arrControllerParts[count($arrControllerParts)-1];
        }
        $data = array_merge(
            [
                'controller' => $controller,
                'method' => $method
            ],
            $data
        );

        $query = http_build_query($data);
        return sprintf('?%s', http_build_query($data));
    }
}