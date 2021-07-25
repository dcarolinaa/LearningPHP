<?php

namespace App\repositories;

use App\models\User;
use App\models\Worker;
use PDO;

class WorkersRepository extends Repository{

    protected function getClassName(): string{
        return Worker::class;
    }

    public function getAllByCompany($companyId){
        $roles = implode(',',[
            User::ROLE_BRANCHADMIN,
            User::ROLE_DELIVERY
        ]);

        $sql = sprintf('
            SELECT w.id, w.id_user, u.first_name, u.last_name, u.phone_number, 
            case r.id when %s then \'Administrador\'  when %s then \'Repartidor\' end rol_name,
            b.name branch_name
            FROM workers w INNER JOIN users u ON w.id_user = u.id
            INNER JOIN roles r on w.rol = r.id
            inner join branches b on w.branch = b.id
            WHERE w.id_company = :id_company and w.rol in ( %s )'
        , User::ROLE_BRANCHADMIN, User::ROLE_DELIVERY, $roles );

        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':id_company' => $companyId        
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    
}