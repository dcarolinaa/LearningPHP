<?php
namespace App\controllers;

class ProductCategory extends Controller{
    public function index() {
        $this->view('product-category/index');
    }
}