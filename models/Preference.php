<?php

namespace App\models;

use Exception;
use App\Config;

class Preference{
    private $shortName;
    private $name;
    private $id;

    public function getId(){
        return $this->id;
    }

    private function setId($id){
        $this->id = $id;
    }

    public function setShortName($shortName){
        $this->shortName = $shortName;
    }

    public function getShortName(){
        return $this->shortName;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function save(){
        $conexion = new \PDO(
            sprintf(
                'mysql:host=%s:%s;dbname=%s',
                Config::DB_HOST,
                Config::DB_PORT,
                Config::DB_NAME,
                
            ), Config::DB_USER,
            Config::DB_PASSWORD
        );
        if(null === $this->id){
            try{    
                $insert = 'Insert into preferences(name, shortname) values(:name, :shortname)';        
                $insertStatement = $conexion->prepare($insert);
                $insertStatement->execute([
                    ':name' => $this->getName(),
                    ':shortname' => $this->getShortName()
                ]);
                
                $this->setId($conexion->lastInsertId());
                return $this->getId();

            }catch(Exception $ex){
                return false;
            }
        }
        die("update");

        
    }
}