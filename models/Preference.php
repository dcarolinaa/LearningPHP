<?php

namespace App\models;

use Exception;
use App\Config;
use PDO;

class Preference{
    private $shortName;
    private $name;
    private $id;

    public function getId(){
        return $this->id;
    }

    private function setId($id){
        //&& is_int($data['id'])
        if(is_numeric($id)){
            $this->id = $id;
        }
        //throw new Exception('Id should be a numeric');        
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

    private static function getConection(){
        $conection = new \PDO(
            sprintf(
                'mysql:host=%s:%s;dbname=%s',
                Config::DB_HOST,
                Config::DB_PORT,
                Config::DB_NAME,
                
            ), Config::DB_USER,
            Config::DB_PASSWORD
        );

        return $conection;
    }

    public function fill($data){
        if(isset($data['id'])){
            $this->setId($data['id']);
        }        
        $this->setShortName($data['short_name']);
        $this->setName($data['name']);
    }

    public static function build($data){
        $preference = new Preference();  
        $preference->fill($data);
        return $preference;
    }

    public static function getById($id){
        $conection = self::getConection();
        $sql = "select * from preferences where id = :id";
        $resultStatement = $conection->prepare($sql);
        $resultStatement->execute([
            ':id' => $id
        ]);

        $result = $resultStatement->fetch(PDO::FETCH_ASSOC);
        $preference = self::build($result);
        return $preference;
    }

    public function delete(){
        try{        
            $conection = self::getConection();
            $sql = "Delete from preferences where id = :id";
            $deleteStatement = $conection->prepare($sql);
            $deleteStatement->execute([
                ':id' => $this->getId()
            ]);

            return true;
        }catch(Exception $ex){
           throw $ex;
        }
    }

    
    /*
    //En ORM se utliza regresando objetos
    public static function getAll(){
        $conection = self::getConection();
        $sql = "select * from preferences";
        $statement = $conection->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    public static function getAll(){
        $conection = self::getConection();
        $sql = "select * from preferences";
        $statement = $conection->query($sql);
        $arrPreferences = [];
        while($result = $statement->fetch()){            
            $arrPreferences[] = self::build($result);
        }
        return $arrPreferences;
    }

    public function save(){
        $conection = $this->getConection();        
        if(null === $this->id){
            try{    
                $insert = 'Insert into preferences(name, short_name) values(:name, :short_name)';        
                $insertStatement = $conection->prepare($insert);
                $insertStatement->execute([
                    ':name' => $this->getName(),
                    ':short_name' => $this->getShortName()
                ]);
                
                $this->setId($conection->lastInsertId());
                return $this->getId();

            }catch(Exception $ex){
                throw $ex;
            }
        }
       
        try{
            $sql = 'UPDATE preferences SET short_name = :short_name, name = :name where id = :id';
            $statement = $conection->prepare($sql);
            $statement->execute([
                ':id' => $this->getId(),
                ':short_name' => $this->getShortName(),
                ':name' => $this->getName()
            ]);
            $this->setId($conection->lastInsertId());
            return $this->getId();
        }catch(Exception $ex){
            return false;
        }

        
    }
}