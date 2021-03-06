<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411175044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE users
            ADD COLUMN email_hash varchar(60) NULL AFTER  email_validated;
        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE users
            DROP COLUMN email_hash
        SQL;

        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
