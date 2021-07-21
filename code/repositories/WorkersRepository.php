<?php

namespace App\repositories;

use App\models\Worker;
use PDO;

class WorkersRepository extends Repository{

    protected function getClassName(): string{
        return Worker::class;
    }

    public function getAllByCompany($companyId){
        $sql = 'SELECT w.id, w.id_user, u.first_name, u.last_name FROM workers w
        inner join users u on w.id_user = u.id WHERE id_company = :id_company';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_company' => $companyId
        ]);


        return $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);

        // $data = [];
        // while($result = $statement->fetch(PDO::FETCH_ASSOC)){
        //     $data[] = $this->buildResult($result);
        // }

        // var_dump($data);
        // die();

        // return $data;
    }
    
}