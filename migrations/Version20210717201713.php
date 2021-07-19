<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717201713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C53D045F4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (code VARCHAR(3) NOT NULL, short_name VARCHAR(20) NOT NULL, full_name VARCHAR(100) NOT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, user_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(150) NOT NULL, post_code VARCHAR(150) NOT NULL, order_number VARCHAR(10) NOT NULL, date DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_F5299398F92F3E70 (country_id), INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_balance (id INT AUTO_INCREMENT NOT NULL, product_supply_id INT DEFAULT NULL, product_id INT DEFAULT NULL, order_id_id INT DEFAULT NULL, size_id INT NOT NULL, color_id INT NOT NULL, quantity NUMERIC(18, 3) NOT NULL, reserved NUMERIC(18, 3) NOT NULL, INDEX IDX_7D2D044E91887655 (product_supply_id), INDEX IDX_7D2D044E4584665A (product_id), INDEX IDX_7D2D044EFCDAEAAA (order_id_id), INDEX IDX_7D2D044E498DA827 (size_id), INDEX IDX_7D2D044E7ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_order_list (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, size_id INT NOT NULL, color_id INT NOT NULL, order_id_id INT NOT NULL, quantity NUMERIC(18, 3) NOT NULL, price NUMERIC(18, 2) NOT NULL, total NUMERIC(18, 2) NOT NULL, INDEX IDX_9A5E9D244584665A (product_id), INDEX IDX_9A5E9D24498DA827 (size_id), INDEX IDX_9A5E9D247ADA1FB5 (color_id), INDEX IDX_9A5E9D24FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_supply (id INT AUTO_INCREMENT NOT NULL, order_number VARCHAR(10) NOT NULL, date DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_supply_list (id INT AUTO_INCREMENT NOT NULL, product_supply_id INT DEFAULT NULL, product_id INT NOT NULL, size_id INT NOT NULL, color_id INT NOT NULL, quantity NUMERIC(18, 3) NOT NULL, INDEX IDX_530F021E91887655 (product_supply_id), INDEX IDX_530F021E4584665A (product_id), INDEX IDX_530F021E498DA827 (size_id), INDEX IDX_530F021E7ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_and_services (id INT AUTO_INCREMENT NOT NULL, measure_code_id VARCHAR(3) DEFAULT NULL, parent_id INT DEFAULT NULL, is_product TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, is_catalog TINYINT(1) NOT NULL, INDEX IDX_CE50D835BCA12A6F (measure_code_id), INDEX IDX_CE50D835727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, phone VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E91887655 FOREIGN KEY (product_supply_id) REFERENCES product_supply (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044EFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D244584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D24498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D247ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D24FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E91887655 FOREIGN KEY (product_supply_id) REFERENCES product_supply (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835BCA12A6F FOREIGN KEY (measure_code_id) REFERENCES measure (code)');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835727ACA70 FOREIGN KEY (parent_id) REFERENCES products_and_services (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E7ADA1FB5');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D247ADA1FB5');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E7ADA1FB5');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F92F3E70');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835BCA12A6F');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044EFCDAEAAA');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D24FCDAEAAA');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E91887655');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E91887655');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E4584665A');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D244584665A');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E4584665A');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835727ACA70');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E498DA827');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D24498DA827');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E498DA827');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE measure');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product_balance');
        $this->addSql('DROP TABLE product_order_list');
        $this->addSql('DROP TABLE product_supply');
        $this->addSql('DROP TABLE product_supply_list');
        $this->addSql('DROP TABLE products_and_services');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE user');
    }
}
