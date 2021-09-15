<?php

namespace App\repositories;

use App\models\Dish;
use PDO;

class DishesRepository extends Repository
{
    protected function getClassName(): string
    {
        return Dish::class;
    }

    public function getAllByCompanyId($companyId)
    {
        $sql = 'SELECT * FROM dishes WHERE id_company = :id_company';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_company' => $companyId
        ]);

        $data = [];
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $this->buildResult($result);
        }

        return $data;

    }

    public function getDishById($id)
    {
        $sql = 'SELECT * FROM dishes WHERE id = :id';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? Dish::build($result) : null;
    }

}
