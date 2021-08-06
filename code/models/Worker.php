<?php

namespace App\models;

class Worker extends Model implements IModel
{
    protected $id;
    private $id_company;
    private $branch;
    private $rol;
    private $id_user;
    private $create_date;

    public static function getAttributes()
    {
        return [
            'id',
            'id_company',
            'branch',
            'rol',
            'id_user',
            'create_date'
        ];
    }

    public static function getTable()
    {
        return 'workers';
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId_company($id_company)
    {
        $this->id_company = $id_company;
    }

    public function getId_company()
    {
        return $this->id_company;
    }

    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

    public function getBranch()
    {
        return $this->branch;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setCreate_date($create_date)
    {
        $this->create_date = $create_date;
    }

    public function getCreate_date()
    {
        return $this->create_date;
    }
}
