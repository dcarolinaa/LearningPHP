<?php

namespace App\services;

use App\config\Config;
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

/*
<?php

namespace App\services;

use PDO;

class GetDBConnection{

    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPassword;

    public function __construct(
        string $dbHost,
        string $dbPort,
        string $dbName,
        string $dbUser,
        string $dbPassword
    )
    {

        $this->dbHost = $dbHost;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        
    }

    public function __invoke()
    {        
        $conection = new PDO(
            sprintf(
                'mysql:host=%s:%s;dbname=%s',
                $this->dbHost,
                $this->dbPort,
                $this->dbName,
                
            ), $this->dbUser,
            $this->dbPassword
        );

        return $conection;        
    }

}
*/