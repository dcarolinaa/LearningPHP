<?php
namespace App\controllers;

use App\Container;
use App\models\Branch;
use App\models\User;
use App\repositories\BranchesRepository;
use App\repositories\CompaniesRepository;
use App\services\CreateBranch;
use App\services\DeleteEntity;
use App\services\ErrorHelper;
use App\services\SaveBranch;

class Branches extends Controller
{
    private $company;
    protected $validProfiles = [User::ROLE_ADMIN];

    public function __construct($method, Container $container, CompaniesRepository $companiesRepository)
    {
        parent::__construct($method, $container);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function create(
        string $googleApiKey,
        ErrorHelper $errorHelper
    ): void {
        $branch = new Branch();
        $branch->fill($_POST);

        $this->view('branches/create', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey,
            'branch' => $branch,
            'errors' => $errorHelper->getAll()
        ]);
    }

    public function edit(
        string $googleApiKey,
        ErrorHelper $errorHelper,
        BranchesRepository $branchesRepository
    ) {
        $branch = $branchesRepository->getById($_GET['id_branch']);
        $this->view('branches/edit', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey,
            'branch' => $branch,
            'errors' => $errorHelper->getAll()
        ]);
    }

    public function confirmDelete(
        BranchesRepository $branchesRepository,
        CompaniesRepository $companiesRepository
    ) {
        $branch = $branchesRepository->getBranchById($_GET['id_branch']);
        $company = $companiesRepository->getById($_GET['id_company']);

        $this->view('components/confirm', [
            'title' => 'Eliminar Negocio',
            'text' => sprintf('Deseas eliminar el branch "%s"', $branch->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/sucursales/%s/delete', $company->getId(), $branch->getId()),
            'urlCancel' => sprintf('/mis-negocios/%s', $company->getSlug())
        ]);
    }

    public function delete(
        BranchesRepository $branchesRepository,
        DeleteEntity $deleteEntity,
        CompaniesRepository $companiesRepository
    ) {
        $company = $companiesRepository->getById($_GET['id_company']);
        $branch = $branchesRepository->getBranchById($_GET['id_branch']);
        $deleteEntity($branch);

        $this->redirectTo(sprintf('/mis-negocios/%s', $company->getSlug()));
    }

    public function store(
        CreateBranch $createBranch,
        ErrorHelper $errorHelper,
        string $googleApiKey,
        CompaniesRepository $companiesRepository
    ) {
        $requiredAttributes = ['name', 'address', 'telephone', 'email'];

        foreach ($requiredAttributes as $attribute) {
            if (trim($_POST[$attribute]) == '') {
                $errorHelper->set($attribute, '_empty', 'Campo obligatorio');
            }
        }

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])) {
            $errorHelper->set('email', '_email_format', 'No es un email valido.');
        }

        if ($errorHelper->hasErrors()) {
            $this->create($googleApiKey, $errorHelper);
            return;
        }

        $branch = $createBranch($_POST);
        $company = $companiesRepository->getById($_GET['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s', $company->getSlug()));
    }

    public function update(
        CompaniesRepository $companiesRepository,
        SaveBranch $saveBranch
    ) {
        $company = $companiesRepository->getById($_GET['id_company']);
        $saveBranch($_POST);

        $this->redirectTo(sprintf('/mis-negocios/%s', $company->getSlug()));
    }

}
