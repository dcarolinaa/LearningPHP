<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530193643 extends AbstractMigration
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
            DROP COLUMN role_id;            
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE user_roles(
                id_user int NOT NULL,
                id_rol int NOT NULL,
                PRIMARY KEY (id_user, id_rol),
                CONSTRAINT user_roles_user FOREIGN KEY (id_user) REFERENCES users (id) ON DELETE CASCADE,
                CONSTRAINT user_roles_rol FOREIGN KEY (id_rol) REFERENCES roles (id) ON DELETE CASCADE
            );

        SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            ALTER TABLE users
            ADD COLUMN role_id INT NULL AFTER create_date;            
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE user_roles;
        SQL;
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
