<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730095739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E7ADA1FB5');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D247ADA1FB5');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E7ADA1FB5');
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E498DA827');
        $this->addSql('ALTER TABLE product_order_list DROP FOREIGN KEY FK_9A5E9D24498DA827');
        $this->addSql('ALTER TABLE product_supply_list DROP FOREIGN KEY FK_530F021E498DA827');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP INDEX IDX_7D2D044E498DA827 ON product_balance');
        $this->addSql('DROP INDEX IDX_7D2D044E7ADA1FB5 ON product_balance');
        $this->addSql('ALTER TABLE product_balance DROP size_id, DROP color_id');
        $this->addSql('DROP INDEX IDX_9A5E9D247ADA1FB5 ON product_order_list');
        $this->addSql('DROP INDEX IDX_9A5E9D24498DA827 ON product_order_list');
        $this->addSql('ALTER TABLE product_order_list DROP size_id, DROP color_id');
        $this->addSql('DROP INDEX IDX_530F021E498DA827 ON product_supply_list');
        $this->addSql('DROP INDEX IDX_530F021E7ADA1FB5 ON product_supply_list');
        $this->addSql('ALTER TABLE product_supply_list DROP size_id, DROP color_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_balance ADD size_id INT NOT NULL, ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_7D2D044E498DA827 ON product_balance (size_id)');
        $this->addSql('CREATE INDEX IDX_7D2D044E7ADA1FB5 ON product_balance (color_id)');
        $this->addSql('ALTER TABLE product_order_list ADD size_id INT NOT NULL, ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D24498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_order_list ADD CONSTRAINT FK_9A5E9D247ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_9A5E9D247ADA1FB5 ON product_order_list (color_id)');
        $this->addSql('CREATE INDEX IDX_9A5E9D24498DA827 ON product_order_list (size_id)');
        $this->addSql('ALTER TABLE product_supply_list ADD size_id INT NOT NULL, ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product_supply_list ADD CONSTRAINT FK_530F021E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_530F021E498DA827 ON product_supply_list (size_id)');
        $this->addSql('CREATE INDEX IDX_530F021E7ADA1FB5 ON product_supply_list (color_id)');
    }
}
