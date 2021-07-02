<?php

namespace App\services;

use App\models\Branch;

class CreateBranch{

    private $saveEntity;
    public function __construct(SaveEntity $saveEntity) {
        $this->saveEntity = $saveEntity;
    }

    public function __invoke($data) {
        $branch = new Branch();
        $branch->fill($data);        
        $this->saveEntity->__invoke($branch);
        return $branch;
    }
}