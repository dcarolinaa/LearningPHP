<?php

namespace App\services;

use App\Config;
use PDO;

class GetDBConnection{
    public function __invoke()
    {        
        $conection = new PDO(
            sprintf(
                'mysql:host=%s:%s;dbname=%s',
                Config::DB_HOST,
                Config::DB_PORT,
                Config::DB_NAME,
                
            ), Config::DB_USER,
            Config::DB_PASSWORD
        );

        return $conection;        
    }  

}