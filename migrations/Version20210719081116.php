<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719081116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835727ACA70');
        $this->addSql('ALTER TABLE products_and_services ADD fontawesome_icon VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835727ACA70 FOREIGN KEY (parent_id) REFERENCES products_and_services (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835727ACA70');
        $this->addSql('ALTER TABLE products_and_services DROP fontawesome_icon');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835727ACA70 FOREIGN KEY (parent_id) REFERENCES products_and_services (id)');
    }
}
