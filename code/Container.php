<?php

namespace App;

use Exception;
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
        if(!key_exists($key, $this->services) && key_exists($key, $this->callbacks)) {
            $this->services[$key] = $this->callbacks[$key]($this);
        }

        if(isset($this->services[$key])) {
            return $this->services[$key];
        }

        throw new Exception("Services don't found");        
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