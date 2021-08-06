<?php

namespace App\services;

use App\models\Worker;

class CreateWorker
{

    private $saveEntity;
    private $addProfileToUser;

    public function __construct(SaveEntity $saveEntity, AddProfileToUser $addProfileToUser)
    {
        $this->saveEntity = $saveEntity;
        $this->addProfileToUser = $addProfileToUser;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function __invoke(array $data): Worker
    {
        $worker = new Worker();
        $id = $data['user']->getId();

        $worker->fill([
            'id_company' => $data['id_company'],
            'branch' => $data['branch'],
            'rol' => $data['rol'],
            'id_user' => $id
        ]);
        $worker->setCreate_date(date('Y-m-d H:i:s'));
        $this->saveEntity->__invoke($worker);

        $this->addProfileToUser->__invoke($data['user'], $data['rol']);

        return $worker;
    }
}
