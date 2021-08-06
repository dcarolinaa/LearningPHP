<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328011822 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
        CREATE TABLE users(
            id int AUTO_INCREMENT,
            first_name varchar(100),
            last_name varchar(100),
            birthdate date,
            email varchar(150),
            username varchar(50),
            password varchar(100),
            create_date datetime,
            role_id int,
            email_validated tinyint(1),
            PRIMARY KEY(id)                           
        )
        SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $sql = "drop table users";
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
