<?php
namespace App\controllers;

use App\models\Company;
use App\repositories\CompaniesRepository;
use App\services\SaveCompany;
use App\services\DeleteEntity;

class Companies extends Controller
{
    public function index(CompaniesRepository $companiesRepository) {        
        $companies = $companiesRepository->getAll();
        $this->view('companies/index', [
            'companies' => $companies
        ]);
    }
    
    public function create() {
        $company = new Company();        
        $this->view('companies/create', [
            'company' => $company
        ]);
    }

    public function edit(CompaniesRepository $companiesRepository) {
        $company = $companiesRepository->getById($_GET['id']);
        $this->view('companies/edit', [
            'company' => $company
        ]);
    }

    public function confirm(CompaniesRepository $companiesRepository) {

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

    public function delete(CompaniesRepository $companiesRepository, DeleteEntity $deleteEntity ) {
        $company = $companiesRepository->getById($_GET['id']);
        $deleteEntity($company);
        $this->redirectTo('/mis-negocios');
    }

    public function store(SaveCompany $saveCompany) {
        $saveCompany([
            'user_admin' => $_SESSION['user_id'],
            'name' => $_POST['name'],
            'status' => Company::STATUS_ACTIVE,            
            'update_user' => $_SESSION['user_id'],
            'logo' => $_FILES['logo']['tmp_name']
        ]);
        $this->redirectTo('/mis-negocios');
    }

    public function update(SaveCompany $saveCompany) {        
        $saveCompany([          
            'id' => $_POST['id'],
            'name' => $_POST['name'],            
            'update_user' => $_SESSION['user_id'],
            'logo' => $_FILES['logo']['tmp_name']
        ]);
 
        $this->redirectTo('/mis-negocios');
    }

    public function show(CompaniesRepository $companiesRepository) {
        $company = $companiesRepository->getById($_GET['id']);
        $this->view('companies/show', [
            'company' => $company
        ]);
    }
}