<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411164436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE roles AUTO_INCREMENT = 1;
            INSERT INTO roles(id, name) Values(NULL, 'SUPER-ADMIN');
            INSERT INTO roles(id, name) Values(NULL, 'ADMIN');
            INSERT INTO roles(id, name) Values(NULL, 'USER');
        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            DELETE FROM roles where name in ('ADMIN','SUPER-ADMIN','USER');
        SQL;
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
