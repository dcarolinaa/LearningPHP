<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711025113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            CREATE TABLE workers(
                id int NOT NULL AUTO_INCREMENT,
                id_company int,
                id_user int,
                create_date datetime,
                PRIMARY KEY (id),
                CONSTRAINT workers_companies_company FOREIGN KEY (id_company) REFERENCES companies (id) ON DELETE CASCADE,
                CONSTRAINT workers_users_user FOREIGN KEY (id_user) REFERENCES users (id) ON DELETE CASCADE                
            );
        SQL;
        $this->addSql($sql);

        $sql = "INSERT INTO roles(id, name) Values(NULL, 'WORKER')";
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches ADD COLUMN lat varchar(25) NULL AFTER email';
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches ADD COLUMN lng varchar(25) NULL AFTER lat';
        $this->addSql($sql);

        //worker_request id correoelectronico idcompany y un md5 sha1...
        $sql = <<<SQL
            CREATE TABLE worker_request(
                id int NOT NULL AUTO_INCREMENT,
                id_company int,
                email varchar(150),
                create_date datetime,
                create_user int,
                request_hash varchar(60),
                PRIMARY KEY (id),
                CONSTRAINT workerrequests_companies_company FOREIGN KEY (id_company) REFERENCES companies (id) ON DELETE CASCADE
            )
        SQL;
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = 'DROP TABLE workers';
        $this->addSql($sql);

        $sql = <<<SQL
            DELETE FROM roles where name in ('WORKER');
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE branches 
            DROP COLUMN lat;            
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE branches 
            DROP COLUMN lng;            
        SQL;
        $this->addSql($sql);

        $sql = 'DROP TABLE worker_request';
        $this->addSql($sql);

    }

    public function isTransactional(): bool
    {
        return false;
    }
}
