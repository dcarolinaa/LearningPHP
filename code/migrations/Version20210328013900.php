<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328013900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            CREATE TABLE roles(
                id int AUTO_INCREMENT,                
                name varchar(30), 
                PRIMARY KEY(id)                           
            )
        SQL;

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = "drop table roles";
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
