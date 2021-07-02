<?php
namespace App\controllers;

class Companies extends Controller
{
    public function index() {
        $this->view('companies/index', []);
    }
    
    public function create() {
        $this->view('companies/create', []);
    }

    public function edit() {
        $this->view('companies/edit', []);
    }

    public function confirm() {
        $this->view('components/confirm', [
            'title' => 'Eliminar Negocio',
            'text' => 'Deseas eliminar este negocio',
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/delete/%s', $_GET['id']),
            'urlCancel' => '/mis-negocios'
        ]);
    }

    public function delete() {
        $this->redirectTo('/mis-negocios');
    }

    public function store() {
        $this->redirectTo('/mis-negocios');
    }

    public function update() {
        $this->redirectTo('/mis-negocios');
    }

    public function show() {
        $this->view('companies/show', [
            'company' => $_GET['id']
        ]);
    }
}