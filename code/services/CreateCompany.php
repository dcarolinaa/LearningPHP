<?php

namespace App\services;

use App\models\Company;
use DateTime;

class CreateCompany {

    private $saveEntity;
    public function __construct(SaveEntity $saveEntity) {
        $this->saveEntity = $saveEntity;
    }

    public function __invoke($data) {
        $company = new Company();
        $company->fill($data);        
        $this->saveEntity->__invoke($company);
        return $company;
    }
}