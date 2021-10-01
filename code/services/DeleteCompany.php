<?php

namespace App\services;

use App\repositories\CompaniesRepository;

class DeleteCompany
{
    private $companiesRepository;
    private $deleteDirectory;
    private $pathCompanyLogo;
    private $deleteEntity;
    private $uploadDir;
    private $homeDir;

    public function __construct(
        CompaniesRepository $companiesRepository,
        DeleteDirectory $deleteDirectory,
        DeleteEntity $deleteEntity,
        string $pathCompanyLogo,
        string $uploadDir,
        string $homeDir
    ) {
        $this->companiesRepository = $companiesRepository;
        $this->deleteDirectory = $deleteDirectory;
        $this->deleteEntity = $deleteEntity;
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->uploadDir = $uploadDir;
        $this->homeDir = $homeDir;
    }

    public function __invoke($id)
    {
        $company = $this->companiesRepository->getById($id);

        $filesPath = sprintf(
            '%s/%s/%s',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $company->getId())
        );

        $cachePath = sprintf(
            '%s/cache/%s/%s',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $company->getId())
        );

        // var_dump($filesPath);
        // var_dump($cachePath);
        // die();
        // $file = sprintf('%s/%s/logo.jpg', $uploadDir, sprintf($pathCompanyLogo, $company->getId()));

        $this->deleteDirectory->__invoke($filesPath);
        $this->deleteDirectory->__invoke($cachePath);

        // rmdir($filesPath);
        // rmdir($cachePath);

        $this->deleteEntity->__invoke($company);
    }
}
