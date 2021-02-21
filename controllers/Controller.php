<?php

namespace App\controllers;

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
        if(null === $controller){
            $controller = $this;
        }

        if(true === is_object($controller)){
            $arrControllerParts = explode('\\',get_class($controller));
            $controller = $arrControllerParts[count($arrControllerParts)-1];
        }
        $data = array_merge(
            [
                'controller' => $controller,
                'method' => $method
            ],
            $data
        );

        $query = http_build_query($data);
        return sprintf('?%s', http_build_query($data));
    }

    public function redirectTo($URL){
        header(
            sprintf('Location:%s',$URL)
        );
    }
}