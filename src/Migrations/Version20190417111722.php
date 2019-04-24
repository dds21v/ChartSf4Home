<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417111722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, name_artist VARCHAR(45) NOT NULL, bio_artiste LONGTEXT DEFAULT NULL, century SMALLINT DEFAULT NULL, image_artiste VARCHAR(255) DEFAULT NULL, slug VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE museum (id INT AUTO_INCREMENT NOT NULL, name_museum VARCHAR(125) NOT NULL, histoire_museum LONGTEXT DEFAULT NULL, image_museum VARCHAR(255) DEFAULT NULL, slug VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre ADD image_art VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE museum');
        $this->addSql('ALTER TABLE oeuvre DROP image_art');
    }
}
