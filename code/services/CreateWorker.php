<?php

namespace App\services;

use App\models\Worker;

class CreateWorker{

    private $saveEntity;

    public function __construct(SaveEntity $saveEntity)
    {
        $this->saveEntity = $saveEntity;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function __invoke(array $data): Worker
    {
        $worker = new Worker();
        $worker->fill([
            'id_company' => $data['id_company'],
            'id_user' => $data['id_user']
        ]);
        $worker->setCreate_date(date('Y-m-d H:i:s'));
        $this->saveEntity->__invoke($worker);

        return $worker;
    }
}
