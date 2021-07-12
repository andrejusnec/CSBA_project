<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712104210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835BCA12A6F');
        $this->addSql('ALTER TABLE measure MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE measure DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE measure DROP id');
        $this->addSql('ALTER TABLE measure ADD PRIMARY KEY (code)');
        $this->addSql('ALTER TABLE products_and_services CHANGE measure_code_id measure_code_id VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835BCA12A6F FOREIGN KEY (measure_code_id) REFERENCES measure (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measure ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835BCA12A6F');
        $this->addSql('ALTER TABLE products_and_services CHANGE measure_code_id measure_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835BCA12A6F FOREIGN KEY (measure_code_id) REFERENCES measure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
