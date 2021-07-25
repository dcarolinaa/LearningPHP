<?php

namespace App\repositories;

use App\models\Branch;
use PDO;

class BranchesRepository extends Repository{

    protected function getClassName(): string
    {
        return Branch::class;
    }

    public function getAllByCompany($companyId){
        $sql  = 'SELECT * FROM branches WHERE id_company = :id_company';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_company' => $companyId        
        ]);
        
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

}