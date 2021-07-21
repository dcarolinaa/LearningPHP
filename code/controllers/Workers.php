<?php 
namespace App\controllers;

use App\models\Company;
use App\repositories\CompaniesRepository;
use App\repositories\UsersRepository;
use App\repositories\WorkerRequestsRepository;
use App\repositories\WorkersRepository;
use App\services\AcceptWorkerRequest;
use App\services\CreateWorkerRequest;
use App\services\InitSession;
use Exception;

class Workers extends Controller {
    
    private $company;

    public function __construct(string $method, CompaniesRepository $companiesRepository) {
        parent::__construct($method, $companiesRepository);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function index(WorkersRepository $workersRepository) {
        $this->view('workers/index', [
            'company' => $this->company,
            'workers' => $workersRepository->getAllByCompany($this->company->getId())
        ]);
    }

    public function workerRequest() {
        $this->view('workers/request', [
            'company' => $this->company
        ]);
    }

    public function sendWorkerRequest(CreateWorkerRequest $createWorkerRequest) {
        $email = $_POST['email'];
        $id = $this->company->getId();

        $createWorkerRequest([
            'id_company' => $id,
            'email' => $email,
            'create_user' => $_SESSION['user_id']
            ]);
        $this->flashNotification(sprintf('Se envió la invitación a %s', $email), 'success');
        $this->redirectTo(sprintf('/mis-negocios/%s/equipo', $id));
    }

    public function acceptWorkerRequest(
        AcceptWorkerRequest $acceptWorkerRequest, 
        WorkerRequestsRepository $workerRequestsRepository,
        UsersRepository $usersRepository,
        InitSession $initSession
    ){
        $hash = $_GET['hash'];
        try
        {
            $acceptWorkerRequest($hash);            
            $workerRequest = $workerRequestsRepository->getByHash($hash);
            $user = $usersRepository->getByEmail($workerRequest->getEmail());
            $initSession($user);
            $this->redirectTo('/');

        }catch(Exception $ex){
            $this->redirectTo(sprintf('/registro/%s', $hash));            
        }
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