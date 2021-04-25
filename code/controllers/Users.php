<?php
namespace App\controllers;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\GetURL;
use App\services\SaveEntity;
use DateTime;

class Users extends Controller{ //Clase

    public function myprofile(){
        $this->view('users/my-profile', $_SESSION);
    }

    public function settings(){
        $getURL = new GetURL();
        $this->view('users/settings',[
            'saveAvatarAction' => $getURL('saveAvatar', $this)
        ]);
    }

    public function saveAvatar(){
        $getURL = new GetURL();
        $tmpFile = $_FILES['avatar']['tmp_name']; 
        $info = pathinfo($_FILES['avatar']['name']);

        $path = sprintf('upload/users/%s', $_SESSION['user_id']);
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        $name = sprintf('%s/%s.%s', $path, 'avatar', $info['extension']);
        move_uploaded_file($tmpFile, $name);

        $this->redirectTo($getURL('settings', $this));
        
    }

    public function logout(){
        $getURL = new GetURL();
        session_destroy();
        $this->redirectTo($getURL('signIn', $this));
    }

    public function login(){
        $userRepository = new UsersRepository();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $userRepository->getByEmailOrUserName($username);

        // var_dump( md5($password));
        // var_dump($user->getPassword() );
        // die();
        if($user->getPassword() ===  md5($password)){
            // die("todo chido");

            // var_dump($_SESSION);
            // die();

            $getURL = new GetURL();
            $myprofile = $getURL('myprofile', $this);

            $_SESSION['loged'] = true;
            $_SESSION['username'] = $user->getUserName();
            $_SESSION['user_id'] = $user->getId();

            $this->redirectTo($myprofile);


        }else{
            die("noup... ");
        }
        
       var_dump($user);        
    }

    public function signIn(){
        $getURL = new GetURL();
        $this->setTemplate('public');
        $this->view('users/login',[
            'action' => $getURL('login', $this)
        ]);
    }

    public function signUp(){ //Método
        $getURL = new GetURL();       
        $this->view('users/sign-up',[
            'action' => $getURL('store', $this)
        ]);
    }

    public function validateEmail(){
        $userRepository = new UsersRepository();
        // var_dump($_GET);
        $saveEntity = new SaveEntity();
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        
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
    }

    // public function edit(){
    //     include 'views/users/edit.php';
    // }

    // public function create(){
    //     include 'views/users/create.php';
    // }
}