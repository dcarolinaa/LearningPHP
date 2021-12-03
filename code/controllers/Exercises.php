<?php

namespace App\controllers;

class Exercises extends Controller
{
    protected $publicMethods = ['index'];

    public function index()
    {
        $this->setTemplate('public');
        $this->view('javascript/index');
    }
}
