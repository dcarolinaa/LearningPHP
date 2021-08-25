<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825032159 extends AbstractMigration
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
            ADD Column id_company int AFTER id,
            ADD CONSTRAINT dishes_companies FOREIGN KEY (id_company)
                REFERENCES companies(id);
SQL;

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE dishes DROP FOREIGN KEY dishes_companies;
            ALTER TABLE dishes DROP COLUMN id_company;
SQL;
        $this->addSql($sql);

    }

    public function isTransactional(): bool
    {
        return false;
    }
}
