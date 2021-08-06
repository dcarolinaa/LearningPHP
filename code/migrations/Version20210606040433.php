<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606040433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            CREATE TABLE companies (
                id INT NOT NULL AUTO_INCREMENT ,
                user_admin INT,
                name VARCHAR(200) NOT NULL , 
                status TINYINT NOT NULL ,                
                create_date DATETIME NOT NULL , 
                update_date DATETIME NOT NULL , 
                update_user INT NOT NULL , 
                PRIMARY KEY (id),
                CONSTRAINT user_companies FOREIGN KEY (user_admin) REFERENCES users (id) ON DELETE CASCADE
                );
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE branches(
                id INT NOT NULL AUTO_INCREMENT,
                id_company int,
                name varchar(200),
                adress varchar(200),
                telephone varchar(15),
                cellphone varchar(15),
                email varchar(20),
                PRIMARY KEY (id),
                CONSTRAINT company_branch FOREIGN KEY (id_company) REFERENCES companies (id) ON DELETE CASCADE
            );
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE menus(
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(200),
                sorting int,
                PRIMARY KEY (id)
            );
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE menu_branches(
                id_menu int,
                id_branch int,
                PRIMARY KEY (id_menu, id_branch),
                CONSTRAINT menu_branches_menu FOREIGN KEY (id_menu) REFERENCES menus (id) ON DELETE CASCADE,
                CONSTRAINT menu_branches_branch FOREIGN KEY (id_branch) REFERENCES branches (id) ON DELETE CASCADE
            );
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE dishes(
                id INT NOT NULL AUTO_INCREMENT,
                name varchar(200),
                description varchar(500),
                PRIMARY KEY (id)
            )
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE menu_dishes(
                id_menu int,
                id_dish int,
                PRIMARY KEY (id_menu, id_dish),
                CONSTRAINT menu_dishes_menu FOREIGN KEY (id_menu) REFERENCES menus (id) ON DELETE CASCADE,
                CONSTRAINT menu_dishes_dish FOREIGN KEY (id_dish) REFERENCES dishes (id) ON DELETE CASCADE
            );
        SQL;
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            DROP TABLE menu_branches;
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE branches;
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE companies;
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE menu_dishes;
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE menus;
        SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            DROP TABLE dishes;
        SQL;
        $this->addSql($sql);

    }

    public function isTransactional(): bool
    {
        return false;
    }
}
