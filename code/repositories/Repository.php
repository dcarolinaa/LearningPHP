<?php

namespace App\repositories;

use App\services\GetDBConnection;
use PDO;
use ReflectionMethod;

abstract class Repository{

    protected $getDBConnection;

    protected abstract function getClassName():string;

    public function __construct(){
        $this->getDBConnection = new GetDBConnection();
    }

    private function getTable(){
        $getTable = new ReflectionMethod($this->getClassName(), 'getTable');
        return $table = $getTable->invoke(null);
    }

    protected function buildResult($result){
        $buil = new ReflectionMethod($this->getClassName(), 'build');
        return $result !== false ? $buil->invokeArgs(null, [$result]) : null;
    }

    public function getAll() {
        $sql = sprintf('SELECT * FROM %s ', $this->getTable());             
        $connection = $this->getDBConnection->__invoke();
        $statement = $connection->prepare($sql);     
        $statement->execute();
        $data = [];
        while($result = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = $this->buildResult($result);
        }
        return $data;
    }

    public function getById($id){
        $sql = sprintf('SELECT * FROM %s where id = :id', $this->getTable());

        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":id" => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $this->buildResult($result);
    }
}