<?php
namespace App\controllers;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\SaveEntity;
use DateTime;

class Users extends Controller{ //Clase

    protected $publicMethods = ['signIn','login','signUp','store','validateEmail'];
    
    public function myprofile(){                 
            $this->view('users/my-profile', []);                
    }

    public function settings(){        
        $getAvatar = new GetAvatar();
        $this->view('users/settings',[
            'saveAvatarAction' => $this->getURL('saveAvatar', $this),
            'userAvatar' => $getAvatar($_SESSION['user_id'])
        ]);
    }

    public function saveAvatar(){
        $getAvatar = new GetAvatar();    
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
        $this->view('users/sign-up',[
            'action' => $this->getURL('store', $this)
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