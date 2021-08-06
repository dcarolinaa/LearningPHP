<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725024650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
        ALTER TABLE worker_request 
        ADD Column branch int AFTER rol,
        ADD CONSTRAINT worker_request_branches FOREIGN KEY (branch)
            REFERENCES branches(id);
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
        ALTER TABLE workers
        ADD Column branch int AFTER id_company,        
        ADD CONSTRAINT worker_branches FOREIGN KEY (branch)
            REFERENCES branches(id);
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
        ALTER TABLE workers        
        ADD Column rol int AFTER branch,
        ADD CONSTRAINT worker_roles FOREIGN KEY (rol)
            REFERENCES roles(id);
SQL;
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
        ALTER TABLE worker_request DROP FOREIGN KEY worker_request_branches;
        ALTER TABLE worker_request DROP COLUMN branch;
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
        ALTER TABLE workers DROP FOREIGN KEY worker_branches;
        ALTER TABLE workers DROP FOREIGN KEY worker_roles;
        ALTER TABLE workers DROP COLUMN branch;
        ALTER TABLE workers DROP COLUMN rol;
SQL;
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
