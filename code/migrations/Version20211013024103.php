<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211013024103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            ALTER TABLE menu_dishes
            DROP FOREIGN KEY menu_dishes_dish;
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_dishes
            DROP FOREIGN KEY menu_dishes_menu;
SQL;
        $this->addSql($sql);

        $sql = 'ALTER TABLE menu_dishes RENAME menu_products';
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            CHANGE COLUMN id_dish id_product int;
SQL;

        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            ADD COLUMN price decimal(18,2) AFTER id_product
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            ADD CONSTRAINT menu_products_menu FOREIGN KEY (id_menu)
                REFERENCES menus (id) ON DELETE CASCADE
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            ADD CONSTRAINT menu_products_product FOREIGN KEY (id_product)
                REFERENCES products (id) ON DELETE CASCADE
SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $sql = <<<SQL
            ALTER TABLE menu_products
            DROP FOREIGN KEY menu_products_menu;
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            DROP FOREIGN KEY menu_products_product;
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            CHANGE COLUMN id_product id_dish int;
SQL;

        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_products
            DROP COLUMN price
SQL;
        $this->addSql($sql);

        $sql = 'ALTER TABLE menu_products RENAME menu_dishes';
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_dishes
            ADD CONSTRAINT menu_dishes_menu FOREIGN KEY (id_menu)
                REFERENCES menus (id) ON DELETE CASCADE
SQL;
        $this->addSql($sql);

        $sql = <<<SQL
            ALTER TABLE menu_dishes
            ADD CONSTRAINT menu_dishes_dish FOREIGN KEY (id_dish)
                REFERENCES products (id) ON DELETE CASCADE
SQL;
        $this->addSql($sql);
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
