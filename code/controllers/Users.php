<?php
namespace App\controllers;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\CreateUser;
use App\services\ErrorHelper;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\GetUrlAvatar;
use App\services\InitSession;
use App\services\SaveEntity;
use DateInterval;
use DateTime;
use Imagine\Gd\Imagine;

class Users extends Controller
{

    protected $publicMethods = ['signIn','login','signUp','store','validateEmail'];

    public function myprofile()
    {
        $this->view('users/my-profile', []);
    }

    public function settings(GetUrlAvatar $getUrlAvatar, UsersRepository $userRepository)
    {
        $errorHelper = new ErrorHelper($_SESSION);
        $user = $userRepository->getById($_SESSION['user_id']);
        $this->view('users/settings', [
            'saveAvatarAction' => $this->getURL('saveAvatar', $this),
            'userAvatar' => $getUrlAvatar($user),
            'errors' => $errorHelper->getAll()
        ]);
    }

    public function avatar()
    {
        header('Pragma: public');
        $days = 86400 * 30;
        header('Cache-Control: max-age=' . $days);

        $dateTime = new DateTime();
        $dateTime->add(new DateInterval('P3M'));
        header('Expires: ' . $dateTime->format('D, d M Y H:i:s \G\M\T'));

        $path = sprintf('upload/cache/users/%s/avatars', $_GET['id']);

        $filename = sprintf('%s/avatar_%s.jpg', $path, $_GET['width']);

        if (file_exists($filename)) {
            header('Content-Type: image/jpeg');
            die(file_get_contents($filename));
        }

        $getAvatar = new GetAvatar();
        $avatar = $getAvatar($_GET['id']);
        $imagine = new Imagine();
        $image = $imagine->open($avatar);
        $image->resize($image->getsize()->widen($_GET['width']));

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $image->save($filename, ['jpeg_quality' => 70]);
        $image->show('jpg', ['jpeg_quality' => 70]);
        die;
    }

    public function saveAvatar(
        ErrorHelper $errorHelper,
        GetAvatar $getAvatar,
        SaveEntity $saveEntity,
        UsersRepository $userRepository
    ) {
        $userId = $_SESSION['user_id'];

        if ($_FILES['avatar']["error"] == UPLOAD_ERR_INI_SIZE) {
            $errorHelper->set('avatar', 'size', 'La imagen es muy grande');
        }

        if ($_FILES['avatar']["error"] != UPLOAD_ERR_OK) {
            $errorHelper->set('avatar', 'generic', 'Ocurrio un error');
        }

        if ($errorHelper->hasErrors()) {
            $this->goBack();
        }

        $tmpFile = $_FILES['avatar']['tmp_name'];
        $info = pathinfo($_FILES['avatar']['name']);

        $path = sprintf('upload/users/%s', $userId);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $name = sprintf('%s/%s.%s', $path, 'avatar', $info['extension']);

        $currentAvatar = $getAvatar( $userId);
        if ($currentAvatar !== GetAvatar::DEFAULT_AVATAR) {
            unlink($currentAvatar);//ELIMINAR ARCHIVO
        }

        $pathCache = sprintf('upload/cache/users/%s/avatars', $userId);
        $files = glob($pathCache . '/*');
        foreach ($files as $tumbnail) {
            if (is_file($tumbnail)) {
                unlink($tumbnail);
            }
        };

        move_uploaded_file($tmpFile, $name);

        $imagine = new \Imagine\Gd\Imagine();
        $image = $imagine->open($name);
        $image->resize($image->getSize()->widen(100));

        $name100x100 = sprintf('%s/%s.%s', $path, 'avatar_100x100', $info['extension']);
        $image->save($name100x100);

        $user = $userRepository->getById($userId);
        $user->setUpdated_at((new DateTime())->format('Y-m-d H:i:s'));

        $saveEntity($user);

        $this->redirectTo($this->getURL('settings', $this));
    }

    public function logout()
    {
        session_destroy();
        $this->redirectTo($this->getURL('signIn', $this));
    }

    public function login(InitSession $initSession, UsersRepository $userRepository)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $userRepository->getByEmailOrUserName($username);
        if ($user->getPassword() === md5($password)) {
            $initSession($user);
            $myprofile = $this->getURL('myprofile', $this);
            $this->redirectTo($myprofile);
        }

        die("noup... ");
        var_dump($user);
    }

    public function signIn()
    {
        $this->setTemplate('public');
        $this->view('users/login', [
            'action' => $this->getURL('login', $this),
            'signUpUrl' => $this->getURL('signUp', $this)
        ]);
    }

    public function signUp()
    {
        $this->setTemplate('public');
        $errorHelper = new ErrorHelper($_SESSION);
        $user = new User();
        $user->fill($_POST);

        $this->view('users/sign-up', [
            'action' => $this->getURL('store', $this),
            'errors' => $errorHelper->getAll(),
            'user' => $user
        ]);
    }

    public function validateEmail(InitSession $initSession)
    {
        $saveEntity = new SaveEntity();
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        $userRepository = new UsersRepository();
        $user = $userRepository->getByEmail($email);

        if ($user->getEmail_validated() || $user->getEmail_hash() !== $hash) {
            die("hash no valido");
        }

        $user->setEmail_validated(User::EMAIL_VALIDATED);
        $saveEntity($user);

        $this->flashNotification('El email ha sido validado');
        $initSession->__invoke($user);

        $this->redirectTo('/');
    }

    public function store(CreateUser $createUser)
    {
        $errorHelper = new ErrorHelper($_SESSION);
        $attributes = ['first_name','last_name','birthdate','email','phone_number','username','password'];

        foreach ($attributes as $att) {
            if (trim($_POST[$att]) == '') {
                $errorHelper->set($att, '_empty', 'Campo obligatorio.');
            }
        }

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])) {
            $errorHelper->set('email', '_email_format', 'No es un email valido.');
        }

        if ($errorHelper->hasErrors()) {
            $this->signUp();
            return;
        }

        $user = $createUser($_POST);

        $this->redirectTo($this->getURL('signIn', $this));
    }
}
