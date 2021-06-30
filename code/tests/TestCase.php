<?php

namespace Tests;

use App\Container;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase{
    private $container;

    const ADMIN_COMPANY_1 = 'admin@romitogo.com';
    
    public function __construct()
    {
        parent::__construct();
        $container = new Container();

        include __DIR__."/../services.php";
        include __DIR__."/../services.test.php";
        $this->container = $container;
    }

    protected function getContainer(){
        return $this->container;
    }
}