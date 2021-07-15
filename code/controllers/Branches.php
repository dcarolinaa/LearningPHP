<?php
namespace App\controllers;

use App\repositories\CompaniesRepository;

class Branches extends Controller
{
    private $company;

    public function __construct($method, CompaniesRepository $companiesRepository) {
        parent::__construct($method);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function create(string $googleApiKey): void {
        $this->view('branches/create', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey
        ]);
    }

    public function edit(string $googleApiKey) {
        $this->view('branches/edit', [
            'company' => $this->company,
            'googleApiKey' => $googleApiKey,
            'i' => $_GET['id_branch']
        ]);
    }

    public function confirmDelete() {
        $this->view('components/confirm', [
            'title' => 'Eliminar Negocio',
            'text' => sprintf('Deseas eliminar el brancha "%s"', 'name'),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/sucursales/%s/delete', $_GET['id_company'],$_GET['id_branch']),
            'urlCancel' => sprintf('/mis-negocios/%s', $_GET['id_company'])
        ]);
    }

    public function delete() {        
        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

    public function store() {        
        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

    public function update() {        
        $this->redirectTo(sprintf('/mis-negocios/%s', $_GET['id_company']));
    }

    public function show() {
        $this->view('sucursales/show', []);
    }
}