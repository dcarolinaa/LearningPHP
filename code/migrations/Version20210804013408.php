<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210804013408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = 'ALTER table companies ADD column slug varchar(200) after name';
        $this->addSql($sql);

        $sql = 'ALTER table branches ADD column slug varchar(200) after name';
        $this->addSql($sql);

        $sql = 'ALTER TABLE companies ADD UNIQUE INDEX index_slug (slug)';
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches ADD UNIQUE INDEX index_slug (slug)';
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = 'ALTER TABLE companies DROP INDEX index_slug';
        $this->addSql($sql);

        $sql = 'ALTER TABLE branches DROP INDEX index_slug';
        $this->addSql($sql);

        $sql = 'ALTER table companies drop column slug';
        $this->addSql($sql);

        $sql = 'ALTER table branches drop column slug';
        $this->addSql($sql);

    }

    public function isTransactional(): bool
    {
        return false;
    }
}
