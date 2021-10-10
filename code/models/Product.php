<?php

namespace App\models;

class Product extends Model implements IModel
{
    protected $id;
    private $id_company;
    private $name;
    private $description;
    private $id_category;
    private $create_date;
    private $update_date;

    public static function getAttributes()
    {
        return [
            'id',
            'id_company',
            'name',
            'description',
            'id_category',
            'create_date',
            'update_date'
        ];
    }

    public static function getTable()
    {
        return 'products';
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

    public function getId_category()
    {
        return $this->id_category;
    }

    public function setId_category($id_category)
    {
        $this->id_category = $id_category;
    }

    public function getCreate_date()
    {
        return $this->create_date;
    }

    public function setCreate_date($create_date)
    {
        $this->create_date = $create_date;
    }

    public function getUpdate_date()
    {
        return $this->update_date;
    }

    public function setUpdate_date($update_date)
    {
        $this->update_date = $update_date;
    }

}
