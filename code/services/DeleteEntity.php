<?php

namespace App\services;

use App\services\GetDBConnection;
use App\models\IModel;

class DeleteEntity
{
    private $getConnection;

    public function __construct(GetDBConnection $getConnection)
    {
        $this->getConnection = $getConnection;
    }

    public function __invoke(IModel $entity)
    {
        $delete = sprintf('DELETE FROM %s where id = :id', $entity->getTable());
        $connection = $this->getConnection->__invoke();
        $statement = $connection->prepare($delete);
        $statement->execute([
            'id' => $entity->getId()
        ]);

    }
}
