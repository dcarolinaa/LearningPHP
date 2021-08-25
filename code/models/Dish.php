<?php

namespace App\models;

class Dish extends Model implements IModel
{
    protected $id;
    private $id_company;
    private $name;
    private $description;

    public static function getAttributes()
    {
        return [
            'id_company',
            'name',
            'description'
        ];
    }

    public static function getTable()
    {
        return 'dishes';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId_company()
    {
        return $this->id_company;
    }

    public function setId_company($id_company)
    {
        $this->id_company = $id_company;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}
