<?php

namespace App\repositories;

use App\models\Company;
use PDO;

class CompaniesRepository extends Repository
{

    protected function getClassName():string
    {
        return Company::class;
    }

    public function getByCompanyName($name)
    {
        $sql = 'SELECT * FROM companies where name = :name';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":name" => $name
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? Company::build($result) : null;
    }

}
