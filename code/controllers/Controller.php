<?php

namespace App\controllers;

use App\services\GetURL;

class Controller{
    private $title = "";

    private $content = "";

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

    public function getURL($method, $controller = null, $data = []){
        $getUrl = new GetURL();
        if(null === $controller){
            $controller = $this;
        }

        return $getUrl($method, $controller, $data);        
    }

    public function redirectTo($URL){
        header(
            sprintf('Location:%s',$URL)
        );
    }
}