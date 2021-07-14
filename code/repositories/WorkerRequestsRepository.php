<?php

namespace App\repositories;

use App\models\WorkerRequest;
use PDO;

class WorkerRequestsRepository extends Repository{

    protected function getClassName(): string
    {
        return WorkerRequest::class;
    }

    public function getByHash(string $hash)
    {
        $sql = 'SELECT * FROM  worker_request WHERE request_hash = :request_hash';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':request_hash' => $hash
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? WorkerRequest::build($result) : null ;
    }
    
}