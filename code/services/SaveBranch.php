<?php

namespace App\services;

use App\repositories\BranchesRepository;


class SaveBranch
{
    private $saveEntity;
    private $branchesRepository;
    private $generateSlug;

    public function __construct(
        SaveEntity $saveEntity,
        BranchesRepository $branchesRepository,
        GenerateSlug $generateSlug
    ) {
        $this->saveEntity = $saveEntity;
        $this->branchesRepository = $branchesRepository;
        $this->generateSlug = $generateSlug;
    }

    public function __invoke($data)
    {
        $branch = $this->branchesRepository->getById($data['id']);
        $branch->fill([

            'name' => $data['name'],
            'slug' => $this->generateSlug->__invoke($data['name']),
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
