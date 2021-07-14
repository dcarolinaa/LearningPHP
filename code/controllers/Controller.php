<?php

namespace App\controllers;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\FlashVars;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\GetUrlAvatar;
use App\services\UserHasProfile;

class Controller{
    private $title = "";

    private $content = "";

    private $template = 'template';

    protected $publicMethods = [];
    protected $getURL;
    protected $container;

    public function __construct($method){        
        $this->getURL = new GetURL();
        $this->validateSession($method);
    }

    public function setContainer($container){
        $this->container = $container;
        return $this;
    }

    public function getContainer(){
        return $this->container;
    }

    private function validateSession($method){
        if(!isset($_SESSION['user_id']) && in_array($method, $this->publicMethods) == false){
            $this->redirectTo($this->getURL('signIn','Users'));
        }
    }

    public function setTemplate($template){
        $this->template = $template;
    }

    protected function getTemplateData(){
        $container = $this->getContainer();
        $getUrlAvatar = $container->get(GetUrlAvatar::class);
        $userRepository = $container->get(UsersRepository::class);
        
        if(isset($_SESSION['user_id'])){            
            $user = $userRepository->getById($_SESSION['user_id']);
            return[
                'username' => $_SESSION['username'] ?? '',
                'userAvatar' => $getUrlAvatar($user, 40),
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

    public function view($view, $data, $return = false){
        extract($data);//array asociativo se obtienen las variables
        ob_start();
            $view = sprintf('views/%s.php', $view);
            include $view;
        $out = ob_get_clean();
        if($return){
            return $out;
        }
        $this->setContent($out);

    }

    public function flashNotification (string $message, string $type = 'success'): void {        
        $flashVars = $this->getContainer()->get(FlashVars::class);
        $notifications = $flashVars->get('__notification');
        
        if($notifications === null) {
            $notifications = [];
        }
        
        $notifications[] = compact('message', 'type');
        $flashVars->set('__notification', $notifications);        
    }

    public function renderTemplate() {
        $content = $this->getContent();
        $title = $this->getTitle();
        extract($this->getTemplateData());
        $flashVars = $this->getContainer()->get(FlashVars::class);
        $__notification = $flashVars->get('__notification');
        include "views/{$this->template}.php";
    }

    public function getURL($method, $controller = null, $data = [], $relative = true){
        return $this->getURL->__invoke($method, $controller, $data, $relative);
    }

    public function goBack(){
        $this->redirectTo($_SERVER['HTTP_REFERER']);        
    }

    public function redirectTo($URL){
        header(
            sprintf('Location:%s',$URL)
        );
        die;
    }
}