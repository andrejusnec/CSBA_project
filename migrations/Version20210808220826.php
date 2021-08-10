<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210808220826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, total NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, quantity INT NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), INDEX IDX_BA388B74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C53D045F4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (code VARCHAR(3) NOT NULL, short_name VARCHAR(20) NOT NULL, full_name VARCHAR(100) NOT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, user_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(150) NOT NULL, post_code VARCHAR(150) NOT NULL, order_number VARCHAR(25) NOT NULL, date DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, order_total NUMERIC(15, 2) DEFAULT NULL, INDEX IDX_F5299398F92F3E70 (country_id), INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, period DATE NOT NULL, price NUMERIC(15, 2) NOT NULL, INDEX IDX_CAC822D94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_balance (id INT AUTO_INCREMENT NOT NULL, product_supply_id INT DEFAULT NULL, product_id INT DEFAULT NULL, order_id_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, quantity NUMERIC(18, 3) NOT NULL, reserved NUMERIC(18, 3) NOT NULL, INDEX IDX_7D2D044E91887655 (product_supply_id), INDEX IDX_7D2D044E4584665A (product_id), INDEX IDX_7D2D044EFCDAEAAA (order_id_id), UNIQUE INDEX UNIQ_7D2D044E1AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_order_list (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, order_id_id INT NOT NULL, quantity NUMERIC(18, 3) NOT NULL, price NUMERIC(18, 2) NOT NULL, total NUMERIC(18, 2) NOT NULL, INDEX IDX_9A5E9D244584665A (product_id), INDEX IDX_9A5E9D24FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_supply (id INT AUTO_INCREMENT NOT NULL, order_number VARCHAR(10) NOT NULL, date DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_supply_list (id INT AUTO_INCREMENT NOT NULL, product_supply_id INT DEFAULT NULL, product_id INT NOT NULL, quantity NUMERIC(18, 3) NOT NULL, INDEX IDX_530F021E91887655 (product_supply_id), INDEX IDX_530F021E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_and_services (id INT AUTO_INCREMENT NOT NULL, measure_code_id VARCHAR(3) DEFAULT NULL, parent_id INT DEFAULT NULL, main_image_id INT DEFAULT NULL, is_product TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, fontawesome_icon VARCHAR(50) DEFAULT NULL, is_catalog TINYINT(1) NOT NULL, INDEX IDX_CE50D835BCA12A6F (measure_code_id), INDEX IDX_CE50D835727ACA70 (parent_id), UNIQUE INDEX UNIQ_CE50D835E4873418 (main_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_and_services_tag (products_and_services_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_CCEA7081666BFC66 (products_and_services_id), INDEX IDX_CCEA7081BAD26311 (tag_id), PRIMARY KEY(products_and_services_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, phone VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5B8739BD4584665A (product_id), INDEX IDX_5B8739BDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E91887655 FOREIGN KEY (product_supply_id) REFERENCES product_supply (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044EFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D244584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D24FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E91887655 FOREIGN KEY (product_supply_id) REFERENCES product_supply (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835BCA12A6F FOREIGN KEY (measure_code_id) REFERENCES measure (code)');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835727ACA70 FOREIGN KEY (parent_id) REFERENCES products_and_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835E4873418 FOREIGN KEY (main_image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_and_services_tag ADD CONSTRAINT FK_CCEA7081666BFC66 FOREIGN KEY (products_and_services_id) REFERENCES products_and_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_and_services_tag ADD CONSTRAINT FK_CCEA7081BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E1AD5CDBF');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F92F3E70');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835E4873418');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835BCA12A6F');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044EFCDAEAAA');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D24FCDAEAAA');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E91887655');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E91887655');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D94584665A');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E4584665A');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D244584665A');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E4584665A');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835727ACA70');
        $this->addSql('ALTER TABLE products_and_services_tag DROP FOREIGN KEY FK_CCEA7081666BFC66');
        $this->addSql('ALTER TABLE wish_list DROP FOREIGN KEY FK_5B8739BD4584665A');
        $this->addSql('ALTER TABLE products_and_services_tag DROP FOREIGN KEY FK_CCEA7081BAD26311');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE wish_list DROP FOREIGN KEY FK_5B8739BDA76ED395');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE measure');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE product_balance');
        $this->addSql('DROP TABLE product_order_list');
        $this->addSql('DROP TABLE product_supply');
        $this->addSql('DROP TABLE product_supply_list');
        $this->addSql('DROP TABLE products_and_services');
        $this->addSql('DROP TABLE products_and_services_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wish_list');
    }
}
