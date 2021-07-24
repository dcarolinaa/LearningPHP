<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724015603 extends AbstractMigration
{
   
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE users
            ADD COLUMN phone_number varchar(15) AFTER email;            
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            INSERT INTO roles(name) values('BRANCH-ADMIN');
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            INSERT INTO roles(name) values('DELIVERY')
        SQL;
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE users 
            DROP COLUMN phone_number
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DELETE FROM roles whwere name = 'BRANCH-ADMIN';
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DELETE FROM roles where name = 'DELIVER'
        SQL;
    }

    public function isTransactional(): bool
    {
        return false;
    }
    
}
