<?php

declare(strict_types=1);

namespace App\Migrations;

use Ausi\SlugGenerator\SlugOptions;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211010021656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            ALTER TABLE dishes
            DROP FOREIGN KEY dishes_companies;
SQL;
        $this->addSql($sql);

        $sql = 'ALTER TABLE dishes RENAME products';
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE products
            ADD CONSTRAINT products_companies FOREIGN KEY (id_company)
                REFERENCES companies (id) ON DELETE CASCADE
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            CREATE TABLE product_categories(
                id int AUTO_INCREMENT,
                name varchar(150) NULL,
                id_company int,
                create_user int,
                create_date datetime,
                PRIMARY KEY (id),
                CONSTRAINT product_categories_companies FOREIGN KEY (id_company)
                REFERENCES companies(id) ON DELETE CASCADE
            );
SQL;

        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE products
            ADD COLUMN id_category int AFTER description
SQL;
        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = <<<SQL
            ALTER TABLE products
            DROP FOREIGN KEY products_companies
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE products
            DROP COLUMN id_category
SQL;
        $this->addSql($sql);

        $sql = 'ALTER TABLE products RENAME dishes';
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE dishes
            ADD CONSTRAINT dishes_companies FOREIGN KEY (id_company)
                REFERENCES companies(id);
SQL;
        $this->addSql($sql);

        $sql = 'DROP TABLE product_categories';
        $this->addSql($sql);

    }

    public function isTransactional(): bool
    {
        return false;
    }
}
