<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210702030000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = 'ALTER TABLE branches CHANGE adress address varchar(200)';
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches modify COLUMN email varchar(100)';
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = 'ALTER TABLE branches CHANGE address adress varchar(200)';
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches modify COLUMN email varchar(20)';
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
