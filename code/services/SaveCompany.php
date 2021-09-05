<?php

namespace App\services;

use App\models\Company;
use App\repositories\CompaniesRepository;
use App\services\MoveFile;

class SaveCompany
{

    private $saveEntity;
    private $companiesRepository;
    private $generateSlug;
    private $moveFile;
    private $pathCompanyLogo;
    private $uploadDir;
    private $homeDir;

    public function __construct(
        MoveFile $moveFile,
        SaveEntity $saveEntity,
        CompaniesRepository $companiesRepository,
        GenerateSlug $generateSlug,
        string $pathCompanyLogo,
        string $uploadDir,
        string $homeDir
    ) {
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->saveEntity = $saveEntity;
        $this->companiesRepository = $companiesRepository;
        $this->generateSlug = $generateSlug;
        $this->moveFile = $moveFile;
        $this->uploadDir = $uploadDir;
        $this->homeDir = $homeDir;
    }

    public function __invoke($data)
    {
        $logo = isset($data['logo']) ? $data['logo'] : false;
        $this->clearData($data);
        $company = $this->getCompany($data);
        $company->fill([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'update_date' => $data['update_date'],
            'create_date' => $data['create_date'],
            'status' => $data['status'] ? $data['status'] : $company->getStatus(),
            'update_user' => $data['update_user'] ? $data['update_user'] : $company->getUpdate_user()
        ]);

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
            $data['create_date']  = $company->getCreate_date();
            unset($data['id']);
        } else {
            $company = new Company();
            $data['create_date'] = $now;
        }

        return $company;
    }

    private function saveLogo($logo, Company $company)
    {
        $path = sprintf(
            '%s/%s',
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $company->getId())
        );
        $this->moveFile->__invoke($logo, $path, 'logo.jpg');
        $this->cleanCache($path);
    }

    private function cleanCache($path)
    {
        $cache = sprintf('%s/cache/%s/logo', $this->homeDir, $path);
        if (!file_exists($cache)) {
            return;
        }

        foreach (scandir($cache) as $file) {
            $fullFileName = sprintf('%s/%s', $cache, $file);
            if (is_file($fullFileName)) {
                unlink($fullFileName);
            }
        }
    }
}
