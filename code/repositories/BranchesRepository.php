<?php

namespace App\repositories;


use App\models\Branch;
use App\models\User;
use PDO;

class BranchesRepository extends Repository
{

    protected function getClassName(): string
    {
        return Branch::class;
    }

    public function getAllByCompany($companyId)
    {
        $sql  = 'SELECT * FROM branches WHERE id_company = :id_company';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_company' => $companyId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getBranchById($id)
    {
        $sql = 'SELECT * FROM branches WHERE id = :id';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? Branch::build($result) : null;
    }

    public function getListByCompany($companyId)
    {
        $sql = <<<SQL
        SELECT
            b.id,
            b.name,
            b.telephone,
            b.address,
            CASE IFNULL(u.username,'') WHEN '' THEN 'Sin Administrador' ELSE CONCAT(' ', '@', u.username) END username
        FROM branches b
        left join workers w on b.id = w.branch
        and b.id_company = w.id_company and w.rol = :id_rol
        left join users u on w.id_user = u.id
        where b.id_company = :id_company
SQL;

        $connection = $this->getDBConnection->__invoke();
        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_rol' => User::ROLE_BRANCHADMIN,
            ':id_company' => $companyId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
