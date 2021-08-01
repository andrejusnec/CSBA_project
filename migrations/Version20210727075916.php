<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727075916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, INDEX IDX_5B8739BD4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BD4584665A FOREIGN KEY (product_id) REFERENCES products_and_services (id)');
        $this->addSql('ALTER TABLE user ADD wish_list_id INT DEFAULT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D69F3311 FOREIGN KEY (wish_list_id) REFERENCES wish_list (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D69F3311 ON user (wish_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D69F3311');
        $this->addSql('DROP TABLE wish_list');
        $this->addSql('DROP INDEX IDX_8D93D649D69F3311 ON user');
        $this->addSql('ALTER TABLE user DROP wish_list_id, CHANGE is_verified is_verified TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
