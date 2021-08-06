<?php

namespace App\services;

use App\models\Branch;

class CreateBranch
{

    private $saveEntity;
    private $generateSlug;

    public function __construct(
        SaveEntity $saveEntity,
        GenerateSlug $generateSlug
    ) {
        $this->saveEntity = $saveEntity;
        $this->generateSlug = $generateSlug;
    }

    public function __invoke($data)
    {
        $branch = new Branch();
        $branch->fill([
            'id_company' => $data['id_company'],
            'slug' => $this->generateSlug->__invoke($data['name']),
            'name' => $data['name'],
            'address' => $data['address'],
            'telephone' => $data['telephone'],
            'cellphone' => $data['cellphone'],
            'email' => $data['email'],
            'lat' => $data['lat'],
            'lng' => $data['lng']
        ]);
        $this->saveEntity->__invoke($branch);
        return $branch;
    }
}
