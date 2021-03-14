<?php
namespace App\services;

use PDO;
use App\Config;
use App\models\IModel;
use Exception;

class SaveEntity{

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

    public function __invoke(IModel $entity)
    {
        $conection = $this->getConection();    
        if( null === $entity->getId()){
            try{
            //Insert
                $table = $entity->getTable();
                $attributes = $entity->getAttributes();
                $fields = implode(',',$attributes);
                $params = implode(',:',$attributes);
                $insert = sprintf('INSERT into %s (%s) values(:%s)', $table, $fields, $params);
                $statement = $conection->prepare($insert);

                $values = [];
                foreach($attributes as $attribute){
                    $getter = sprintf('get%s',ucfirst($attribute));
                    $param = sprintf(':%s',$attribute);
                    $values[$param] = $entity->{($getter)}();
                }                
                $statement->execute($values);
                $entity->setId($conection->lastInsertId());
                return $entity->getId();
            }catch(Exception $ex){
                throw $ex;
            }            
        }else{
            //Update
        }
        

        if(null === $this->id){
            try{    
                $insert = 'Insert into preferences(name, shortname) values(:name, :shortname)';        
                $insertStatement = $conection->prepare($insert);
                $insertStatement->execute([
                    ':name' => $this->getName(),
                    ':shortname' => $this->getShortName()
                ]);
                
                $this->setId($conection->lastInsertId());
                return $this->getId();

            }catch(Exception $ex){
                throw $ex;
            }
        }
       
        try{
            $sql = 'UPDATE preferences SET short_name = :shortname, name = :name where id = :id';
            $statement = $conection->prepare($sql);
            $statement->execute([
                ':id' => $this->getId(),
                ':shortname' => $this->getShortName(),
                ':name' => $this->getName()
            ]);
            $this->setId($conection->lastInsertId());
            return $this->getId();
        }catch(Exception $ex){
            return false;
        }

        
    }

}
//SOLID - TDD