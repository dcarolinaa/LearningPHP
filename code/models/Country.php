<?php
namespace App\models;

class Country extends Model implements IModel
{
    private $name;
    private $code;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public static function getAttributes()
    {
        return [
            'id',
            'code',
            'name'
        ];
    }

    public static function getTable()
    {
        return 'countries';
    }
}
