<?php

namespace App\services;

use App\models\Company;
use App\repositories\CompaniesRepository;

class SaveCompany
{

    private $saveEntity;
    private $companiesRepository;
    private $generateSlug;

    public function __construct(
        SaveEntity $saveEntity,
        CompaniesRepository $companiesRepository,
        GenerateSlug $generateSlug
    ) {
        $this->saveEntity = $saveEntity;
        $this->companiesRepository = $companiesRepository;
        $this->generateSlug = $generateSlug;
    }

    public function __invoke($data)
    {
        $logo = isset($data['logo']) ? $data['logo'] : false;
        $this->clearData($data);

        $company = $this->getCompany($data);
        $company->fill($data);
        $this->saveEntity->__invoke($company);

        if ($logo) {
            $this->saveLogo($logo, $company);
        }

        return $company;
    }

    private function clearData(&$data)
    {
        unset($data['logo']);
        unset($data['create_date']);
        unset($data['update_date']);
    }

    private function getCompany(&$data)
    {
        $now = date('Y-m-d H:i:s');
        $data['update_date'] = $now;
        $data['slug'] = $this->generateSlug->__invoke($data['name']);

        if (isset($data['id'])) {
            $company = $this->companiesRepository->getById($data['id']);
            unset($data['id']);
        } else {
            $company = new Company();
            $data['create_date'] = $now;
        }

        return $company;
    }

    private function saveLogo($logo, Company $company)
    {
        $path = sprintf('upload/companies/%s', $company->getId());
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        move_uploaded_file($logo, sprintf('%s/logo.jpg', $path));
    }
}
