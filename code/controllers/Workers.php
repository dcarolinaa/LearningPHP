<?php
namespace App\controllers;

use App\Container;
use App\models\User;
use App\repositories\BranchesRepository;
use App\repositories\CompaniesRepository;
use App\repositories\UsersRepository;
use App\repositories\WorkerRequestsRepository;
use App\repositories\WorkersRepository;
use App\services\AcceptWorkerRequest;
use App\services\CreateWorkerRequest;
use App\services\ErrorHelper;
use App\services\InitSession;
use Exception;

class Workers extends Controller
{

    private $company;
    protected $validProfiles = [User::ROLE_ADMIN];
    protected $publicMethods = ['acceptWorkerRequest'];

    public function __construct(string $method, Container $container, CompaniesRepository $companiesRepository)
    {
        parent::__construct($method, $container);
        $this->company = $companiesRepository->getById($_GET['id_company']);
    }

    public function index(WorkersRepository $workersRepository)
    {
        $this->view('workers/index', [
            'company' => $this->company,
            'workers' => $workersRepository->getAllByCompany($this->company->getId())
        ]);
    }

    public function workerRequest(BranchesRepository $branchesRepository, ErrorHelper $errorHelper)
    {
        $this->view('workers/request', [
            'company' => $this->company,
            'rolBranchAdmin' => User::ROLE_BRANCHADMIN,
            'rolDelivery' => User::ROLE_DELIVERY,
            'branchesList' => $branchesRepository->getAllByCompany($this->company->getId()),
            'email' => $_POST['email'] ?? '',
            'errors' => $errorHelper->getAll()
        ]);
    }

    public function sendWorkerRequest(
        CreateWorkerRequest $createWorkerRequest,
        WorkerRequestsRepository $workerRequestsRepository,
        ErrorHelper $errorHelper,
        BranchesRepository $branchesRepository
    ) {
        $email = $_POST['email'];
        $id = $this->company->getId();

        if ($workerRequestsRepository->findByEmailCompany($email, $id)) {
            $errorHelper->set('email', 'used', '¡Este monito ya trabaja contigo!');
        }

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])) {
            $errorHelper->set('email', '_email_format', 'No es un email valido.');
        }

        if ($errorHelper->hasErrors()) {
            $this->workerRequest($branchesRepository, $errorHelper);
            return;
        }

        $createWorkerRequest([
            'id_company' => $id,
            'email' => $email,
            'create_user' => $_SESSION['user_id'],
            'rol' => $_POST['rol'],
            'branch' => $_POST['branch']
            ]);
        $this->flashNotification(sprintf('Se envió la invitación a %s', $email), 'success');
        $this->redirectTo(sprintf('/mis-negocios/%s/equipo', $id));
    }

    public function acceptWorkerRequest(
        AcceptWorkerRequest $acceptWorkerRequest,
        WorkerRequestsRepository $workerRequestsRepository,
        UsersRepository $usersRepository,
        InitSession $initSession
    ) {
        $hash = $_GET['hash'];
        try {
            $acceptWorkerRequest($hash);
            $workerRequest = $workerRequestsRepository->getByHash($hash);
            $user = $usersRepository->getByEmail($workerRequest->getEmail());
            $initSession($user);
            $this->redirectTo('/');
        } catch (Exception $ex) {
            die($ex);
            $this->redirectTo(sprintf('/registro/%s', $hash));
        }
    }

    public function confirmRemoveAdministration()
    {
        $this->view('components/confirm', [
            'title' => 'Retirar la administración',
            'text' => sprintf('Deseas retirar la administracion de la sucursal "%s" a %s', 'branch', 'worker'),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/equipo/worker/%s/delete', $_GET['id_company'], $_GET['id_worker']),
            'urlCancel' => sprintf('/mis-negocios/%s/equipo', $_GET['id_company'])
        ]);
    }

    public function removeAdministration()
    {
        $this->redirectTo(sprintf('/mis-negocios/%s/equipo', $this->company->getId()));
    }

    public function confirmRemove()
    {
        $this->view('components/confirm', [
            'title' => 'Eliminar trabajador',
            'text' => sprintf('Deseas eliminar a %s', 'worker'),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/equipo/worker/%s/delete', $_GET['id_company'], $_GET['id_worker']),
            'urlCancel' => sprintf('/mis-negocios/%s/equipo', $_GET['id_company'])
        ]);
    }


}
