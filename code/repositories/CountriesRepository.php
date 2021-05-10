<?php

namespace App\repositories;
use App\models\Country;
use PDO;

class CountriesRepository extends Repository{

    protected function getClassName():string{
        return Country::class;
    }

    public function getAll(){
        $sql = 'SELECT * FROM countries';
        $connection = $this->getDBConnection->__invoke();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = [];
        while($result = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = Country::build($result);
        }
        return $data;
    }

    public function getLast(){
        $sql = 'SELECT * from countries order by id desc LIMIT 1';
        $connection = $this->getDBConnection->__invoke();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //return Country::build($result);
        return $result !== false ?  Country::build($result) : null;
    }

}