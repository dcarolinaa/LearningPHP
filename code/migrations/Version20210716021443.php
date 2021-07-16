<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716021443 extends AbstractMigration
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
            ADD COLUMN accepted boolean default 0 AFTER request_hash;            
        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE worker_request
            DROP COLUMN accepted;            
        SQL;
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
