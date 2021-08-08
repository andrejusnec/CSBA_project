<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210807181556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_balance ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_balance ADD CONSTRAINT FK_7D2D044E1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D2D044E1AD5CDBF ON product_balance (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_balance DROP FOREIGN KEY FK_7D2D044E1AD5CDBF');
        $this->addSql('DROP INDEX UNIQ_7D2D044E1AD5CDBF ON product_balance');
        $this->addSql('ALTER TABLE product_balance DROP cart_id');
    }
}
