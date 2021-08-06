<?php
namespace App\controllers;

use App\Container;
use App\models\User;
use App\repositories\BranchesRepository;
use App\repositories\CompaniesRepository;
use App\services\CreateBranch;
use App\services\DeleteEntity;
use App\services\ErrorHelper;

class Branches extends Controller
{
    private $company;
    protected $validProfiles = [User::ROLE_ADMIN];

    public function __construct($method, Container $container, CompaniesRepository $companiesRepository)
    {
        parent::__construct($method, $container);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function create(string $googleApiKey): void
    {
        $this->view('branches/create', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey
        ]);
    }

    public function edit(string $googleApiKey)
    {
        $this->view('branches/edit', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey,
            'i' => $_GET['id_branch']
        ]);
    }

    public function confirmDelete(BranchesRepository $branchesRepository)
    {
        $id = $_GET['id_branch'];
        $branch = $branchesRepository->getBranchById($id);

        $this->view('components/confirm', [
            'title' => 'Eliminar Negocio',
            'text' => sprintf('Deseas eliminar el brancha "%s"', $branch->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/sucursales/%s/delete', $_GET['id_company'], $branch->getId()),
            'urlCancel' => sprintf('/mis-negocios/%s', $_GET['id_company'])
        ]);
    }

    public function delete(BranchesRepository $branchesRepository, DeleteEntity $deleteEntity)
    {
        $branch = $branchesRepository->getBranchById($_GET['id_branch']);
        $deleteEntity($branch);

        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

    public function store(
        CreateBranch $createBranch,
        ErrorHelper $errorHelper,
        string $googleApiKey
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
            $this->create($googleApiKey);
            return;
        }

        $branch = $createBranch($_POST);

        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

    public function update()
    {
        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

}
