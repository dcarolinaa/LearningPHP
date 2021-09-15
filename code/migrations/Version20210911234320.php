<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911234320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE dishes 
            ADD Column create_date datetime AFTER description;
SQL;

        $this->addSql($sql);

        $sql = <<<SQL
        ALTER TABLE dishes 
        ADD Column update_date datetime AFTER create_date;
SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = 'ALTER TABLE dishes DROP COLUMN create_date';
        $this->addSql($sql);

        $sql = 'ALTER TABLE dishes DROP COLUMN update_date';
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
