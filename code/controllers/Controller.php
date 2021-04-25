<?php

namespace App\controllers;

use App\services\GetAvatar;
use App\services\GetURL;

class Controller{
    private $title = "";

    private $content = "";

    private $template = 'template';

    protected $publicMethods = [];
    protected $getURL;

    public function __construct(){
        $this->validateSession();
        $this->getURL = new GetURL();
    }

    private function validateSession(){
        if(empty($_SESSION) && in_array($_GET['method'], $this->publicMethods) == false){
            $this->redirectTo($this->getURL('signIn',$this));
        }
    }

    public function setTemplate($template){
        $this->template = $template;
    }

    protected function getTemplateData(){
        $getAvatar = new GetAvatar();
        if(empty($_SESSION) === false){
            return[
                'username' => $_SESSION['username'] ?? '',
                'userAvatar' => $getAvatar($_SESSION['user_id']),
                'userMenu' => [
                    'profile' => $this->getUrl('myprofile', 'Users'),
                    'settings' => $this->getUrl('settings','Users'),
                    'logout' => $this->getUrl('logout','Users')
                ]
            ];
        }

        return [];
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }    

    public function view($view, $data){
        extract($data);//array asociativo se obtienen las variables
        ob_start();
            $view = sprintf('views/%s.php', $view);
            include $view;
        $out = ob_get_clean();
        $this->setContent($out);

    }

    public function renderTemplate(){
        $content = $this->getContent();
        $title = $this->getTitle();
        extract($this->getTemplateData());
        include "views/{$this->template}.php";
    }

    public function getURL($method, $controller = null, $data = [], $relative = true){
        return $this->getURL->__invoke($method, $controller, $data, $relative);
    }

    public function redirectTo($URL){
        header(
            sprintf('Location:%s',$URL)
        );
    }
}