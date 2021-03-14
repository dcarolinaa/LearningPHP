<?php
namespace App\models;

interface IModel{
    public function getId();
    public function setId($id);
    public static function getTable();
    public static function getAttributes();    
}