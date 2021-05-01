<?php
namespace App\controllers;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\ErrorHelper;
use App\services\FlashVars;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\SaveEntity;
use DateTime;
use Doctrine\DBAL\Types\VarDateTimeType;

class Users extends Controller{ //Clase

    protected $publicMethods = ['signIn','login','signUp','store','validateEmail'];
    
    public function myprofile(){                 
            $this->view('users/my-profile', []);                
    }

    public function settings(){        
        $errorHelper = new ErrorHelper($_SESSION);
        $getAvatar = new GetAvatar();
        $this->view('users/settings',[
            'saveAvatarAction' => $this->getURL('saveAvatar', $this),
            'userAvatar' => $getAvatar($_SESSION['user_id']),
            'errors' => $errorHelper->getAll()            
        ]);
    }

    public function saveAvatar(){
        $errorHelper = new ErrorHelper($_SESSION);

        $getAvatar = new GetAvatar();
        
        if($_FILES['avatar']["error"] == UPLOAD_ERR_INI_SIZE){
            $errorHelper->set('avatar','size','La imagen es muy grande');            
        }
        
        if($_FILES['avatar']["error"] != UPLOAD_ERR_OK){
            $errorHelper->set('avatar','generic', 'Ocurrio un error');            
        }

        if($errorHelper->hasErrors()){
            $this->goBack();
        }
        
        $tmpFile = $_FILES['avatar']['tmp_name']; 
        $info = pathinfo($_FILES['avatar']['name']);

        $path = sprintf('upload/users/%s', $_SESSION['user_id']);
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        $name = sprintf('%s/%s.%s', $path, 'avatar', $info['extension']);

        $currentAvatar = $getAvatar( $_SESSION['user_id']);
        if($currentAvatar !== GetAvatar::DEFAULT_AVATAR){
            unlink($currentAvatar);//ELIMINAR ARCHIVO
        }

        move_uploaded_file($tmpFile, $name);
        $this->redirectTo($this->getURL('settings', $this));
    }

    public function logout(){        
        session_destroy();
        $this->redirectTo($this->getURL('signIn', $this));
    }

    public function login(){
        $userRepository = new UsersRepository();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $userRepository->getByEmailOrUserName($username);
        if($user->getPassword() ===  md5($password)){
            $_SESSION['loged'] = true;
            $_SESSION['username'] = $user->getUserName();
            $_SESSION['user_id'] = $user->getId();
            $myprofile = $this->getURL('myprofile', $this);
            $this->redirectTo($myprofile);
        }
            
        die("noup... ");        
        var_dump($user);        
    }

    public function signIn(){        
        $this->setTemplate('public');
        $this->view('users/login',[
            'action' => $this->getURL('login', $this),
            'signUpUrl' => $this->getURL('signUp',$this)
        ]);
    }

    public function signUp(){
        $this->setTemplate('public');
        $errorHelper = new ErrorHelper($_SESSION);
        $user = new User();
        $user->fill($_POST);

        $this->view('users/sign-up',[
            'action' => $this->getURL('store', $this),
            'errors' => $errorHelper->getAll(),
            'user' => $user
        ]);
    }

    public function validateEmail(){                
        $saveEntity = new SaveEntity();
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        $userRepository = new UsersRepository();
        $user = $userRepository->getByEmail($email);
        
        if( $user->getEmail_validated() || $user->getEmail_hash() !== $hash)
        {
            die("hash no valido");
        }

        $user->setEmail_validated(User::EMAIL_VALIDATED);
        $saveEntity($user);
        die("valido");
    }

    public function store(){
        $errorHelper = new ErrorHelper($_SESSION);
        $attributes = ['first_name','last_name','birthdate','email','username','password'];

        foreach($attributes as $att){
            if(trim($_POST[$att]) == ''){
                $errorHelper->set($att, '_empty','Campo obligatorio.');
            }
        }

        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])){
            $errorHelper->set('email', '_email_format','No es un email valido.');
        }

        if($errorHelper->hasErrors()){
           $this->signUp();
           return;
        }

        // var_dump($_POST);
        $getULR = new GetURL();
        $user = new \App\models\User;
        $user->fill($_POST);

        $saveEntity = new SaveEntity();
        
        $user->setCreate_date(
            (new DateTime())->format('Y-m-d H:i:s')
        );
        $user->setRole_id(User::ROLE_USER);
        $user->setPassword($_POST['password'], true);
        $hash = hash('sha224', uniqid());
        $user->setEmail_hash($hash);
        
        $saveEntity($user);
        
        $link = $getULR('validateEmail', $this, [
            'hash' => $hash,
            'email' => $user->getEmail()
        ], false);
        
        $message = sprintf('Hola, bienvenido a RomiToGo, activa tu cuenta con el siguiente link: <a href="%1$s">%1$s</a>', $link);
        $header = 'From: romi@romitogo.com'. "\r\n";;
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail($user->getEmail(), 'WELCOME', $message, $header);
        $this->redirectTo($this->getURL('signIn', $this));
    }
}