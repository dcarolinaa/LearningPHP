<?php

namespace App;

use phpDocumentor\Reflection\Types\This;
use ReflectionClass;
use ReflectionMethod;

class Container{
    private $callbacks = [];
    private $services = [];

    public function add($key, $callback = null)
    {
        if($callback !== null){
            $this->callbacks[$key] = $callback;
        }else {
            $this->callbacks[$key] = function() use ($key){
                //Use para poder utilizar la variable recibida en la función de arriba...
                return $this->build($key);
            };
        }

        return $this;        
    }

    public function get($key){
        if(!key_exists($key, $this->services)){
            $this->services[$key] = $this->callbacks[$key]($this);
        }

        return $this->services[$key];
    }

    public function callMethod($method, $object){
        $reflectionMethod = new ReflectionMethod(get_class($object), $method);
        $params = $this->getParameters($reflectionMethod);

        return $reflectionMethod->invokeArgs($object, $params);
    }

    public function build($className){
        $reflectionClass = new ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getConstructor();
        if($reflectionMethod){
            $params = $this->getParameters($reflectionMethod);
            return $reflectionClass->newInstanceArgs($params);
        }

        return $reflectionClass->newInstance();
    }

    private function getParameters(ReflectionMethod $reflectionMethod){
        $parameters = $reflectionMethod->getParameters();
        $params = [];

        foreach($parameters as $parameter){
            $classNameParameter = $parameter->getType()->getName();
            $params[] = $this->get($classNameParameter);
        }

        return $params;
    }

}