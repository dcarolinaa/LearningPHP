<?php 
namespace App\controllers;

use App\repositories\CompaniesRepository;

class Workers extends Controller {
    
    private $company;

    public function __construct(string $method, CompaniesRepository $companiesRepository) {
        parent::__construct($method, $companiesRepository);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function index() {
        $this->view('workers/index', [
            'company' => $this->company
        ]);
    }

    public function workerRequest() {
        $this->view('workers/request', [
            'company' => $this->company
        ]);
    }

    public function sendWorkerRequest() {        
        $this->flashNotification(sprintf('Se envió la invitación a %s', $_POST['email']), 'success');
        $this->redirectTo(sprintf('/mis-negocios/%s/equipo', $this->company->getId()));
    }

    public function confirmRemoveAdministration() {
        $this->view('components/confirm', [
            'title' => 'Retirar la administración',
            'text' => sprintf('Deseas retirar la administracion de la sucursal "%s" a %s', 'branch', 'worker'),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/equipo/worker/%s/delete', $_GET['id_company'],$_GET['id_worker']),
            'urlCancel' => sprintf('/mis-negocios/%s/equipo', $_GET['id_company'])
        ]);
    }

    public function removeAdministration() {
        $this->redirectTo(sprintf('/mis-negocios/%s/equipo', $this->company->getId()));
    }

    public function confirmRemove() {
        $this->view('components/confirm', [
            'title' => 'Eliminar trabajador',
            'text' => sprintf('Deseas eliminar a %s', 'worker'),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/equipo/worker/%s/delete', $_GET['id_company'],$_GET['id_worker']),
            'urlCancel' => sprintf('/mis-negocios/%s/equipo', $_GET['id_company'])
        ]);
    }
    
    
}