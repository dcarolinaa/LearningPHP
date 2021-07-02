<?php

namespace Tests;

use App\Container;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase{
    private $container;

    const ADMIN_COMPANY_1 = 'admin@sushigo.com';
    const ADMIN_COMPANY_1_ID = 2;
    const COMPANY_1_ID = 1;
    const COMPANY_1_BRANCH_1 = 1;
    
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