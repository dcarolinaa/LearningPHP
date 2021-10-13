<?php

namespace App\models;

class ProductCategory extends Model implements IModel
{
    protected $id;
    private $name;
    private $id_company;
    private $create_user;
    private $create_date;

    public static function getAttributes()
    {
        return [
            'id',
            'name',
            'id_company',
            'create_user',
            'create_date'
        ];
    }

    public static function getTable()
    {
        return 'product_categories';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name  = $name;
    }

    public function getId_company()
    {
        return $this->id_company;
    }

    public function setId_company($id_company)
    {
        $this->id_company = $id_company;
    }

    public function getCreate_user()
    {
        return $this->create_user;
    }

    public function setCreate_user($create_user)
    {
        $this->create_user = $create_user;
    }

    public function getCreate_date()
    {
        return $this->create_date;
    }

    public function setCreate_date($create_date)
    {
        $this->create_date = $create_date;
    }

}
