<?php

namespace App\repositories;

use App\models\Product;
use PDO;

class ProductsRepository extends Repository
{
    protected function getClassName(): string
    {
        return Product::class;
    }

    public function getAllByCompanyId($companyId)
    {
        $sql = 'SELECT * FROM products WHERE id_company = :id_company';
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

    public function getProductById($id)
    {
        $sql = 'SELECT * FROM products WHERE id = :id';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? Product::build($result) : null;
    }

}
