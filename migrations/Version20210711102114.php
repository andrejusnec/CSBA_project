<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711102114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_and_services ADD parent_id INT DEFAULT NULL, ADD is_catalog TINYINT(1) NOT NULL, CHANGE measure_code_id measure_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products_and_services ADD CONSTRAINT FK_CE50D835727ACA70 FOREIGN KEY (parent_id) REFERENCES products_and_services (id)');
        $this->addSql('CREATE INDEX IDX_CE50D835727ACA70 ON products_and_services (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_and_services DROP FOREIGN KEY FK_CE50D835727ACA70');
        $this->addSql('DROP INDEX IDX_CE50D835727ACA70 ON products_and_services');
        $this->addSql('ALTER TABLE products_and_services DROP parent_id, DROP is_catalog, CHANGE measure_code_id measure_code_id INT NOT NULL');
    }
}
