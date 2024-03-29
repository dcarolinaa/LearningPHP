<?php

namespace App\models;

use PhpParser\Node\Stmt\Return_;

class Model
{

    protected $id;

    public function setId($id)
    {
        if ($id === "") {
            $id = null;
        }

        $this->id = $id;
    }

    public function fill($data)
    {
        foreach ($data as $key => $value) {
            $setter = sprintf('set%s', ucfirst($key));
            $this->{($setter)}($value);
        }

        return $this;
    }

    public static function build($data)
    {
        $className = static::class;
        $refClass = new \ReflectionClass($className);
        $entity = $refClass->newInstance()->fill($data);
        return $entity;
    }

}
