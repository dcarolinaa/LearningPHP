<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228004316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            CREATE TABLE preferences(
                id int AUTO_INCREMENT,
                shortname varchar(50) NULL,
                name varchar(150) NULL,
                PRIMARY KEY (id)
            )
        SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $sql = "drop table preferences";
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
