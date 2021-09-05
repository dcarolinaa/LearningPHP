<?php
namespace App\controllers;

use App\models\Company;
use App\models\User;
use App\repositories\BranchesRepository;
use App\repositories\CompaniesRepository;
use App\services\SaveCompany;
use App\services\DeleteEntity;
use App\services\RecoveryAndSendImage;
use Exception;

class Companies extends Controller
{
    protected $validProfiles = [User::ROLE_ADMIN];

    public function index(CompaniesRepository $companiesRepository)
    {
        $companies = $companiesRepository->getAll();
        $this->view('companies/index', [
            'companies' => $companies
        ]);
    }

    public function create()
    {
        $company = new Company();
        $this->view('companies/create', [
            'company' => $company
        ]);
    }

    public function edit(CompaniesRepository $companiesRepository)
    {
        $company = $companiesRepository->getById($_GET['id']);
        $this->view('companies/edit', [
            'company' => $company
        ]);
    }

    public function confirm(CompaniesRepository $companiesRepository)
    {
        $company = $companiesRepository->getById($_GET['id']);

        $this->view('components/confirm', [
            'title' => 'Eliminar Negocio',
            'text' => sprintf('Deseas eliminar "%s"', $company->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/delete/%s', $_GET['id']),
            'urlCancel' => '/mis-negocios'
        ]);
    }

    public function delete(CompaniesRepository $companiesRepository, DeleteEntity $deleteEntity)
    {
        $company = $companiesRepository->getById($_GET['id']);
        $deleteEntity($company);
        $this->redirectTo('/mis-negocios');
    }

    public function store(SaveCompany $saveCompany)
    {
        $saveCompany([
            'user_admin' => $_SESSION['user_id'],
            'name' => $_POST['name'],
            'status' => Company::STATUS_ACTIVE,
            'update_user' => $_SESSION['user_id'],
            'logo' => $_FILES['logo']['tmp_name']
        ]);
        $this->redirectTo('/mis-negocios');
    }

    public function update(SaveCompany $saveCompany)
    {
        $saveCompany([
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'update_user' => $_SESSION['user_id'],
            'logo' => $_FILES['logo']['tmp_name']
        ]);

        $this->redirectTo('/mis-negocios');
    }

    public function show(CompaniesRepository $companiesRepository, BranchesRepository $branchesRepository)
    {
        $company = $companiesRepository->getBySlug($_GET['slug']);
        $this->view('companies/show', [
            'company' => $company,
            'branches' => $branchesRepository->getListByCompany($company->getId())
        ]);
    }

    public function defaultLogo(string $defaultCompanyLogo, RecoveryAndSendImage $recoveryAndSendImage)
    {
        $recoveryAndSendImage($defaultCompanyLogo, $_GET['width']);
    }

    public function logo(
        CompaniesRepository $companiesRepository,
        string $pathCompanyLogo,
        string $uploadDir,
        string $urlDefaultCompanyLogo,
        RecoveryAndSendImage $recoveryAndSendImage
    ) {
        $company = $companiesRepository->getBySlug($_GET['slug']);
        $file = sprintf('%s/%s/logo.jpg', $uploadDir, sprintf($pathCompanyLogo, $company->getId()));
        try {
            $recoveryAndSendImage($file, $_GET['width']);
        } catch (Exception $ex) {
            $this->redirectTo(sprintf($urlDefaultCompanyLogo, $_GET['width'] ), true);
        }
    }
}
