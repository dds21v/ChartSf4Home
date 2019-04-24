<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417112012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oeuvre_artiste (oeuvre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_DB75DF1488194DE8 (oeuvre_id), INDEX IDX_DB75DF1421D25844 (artiste_id), PRIMARY KEY(oeuvre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvre_museum (oeuvre_id INT NOT NULL, museum_id INT NOT NULL, INDEX IDX_A262609988194DE8 (oeuvre_id), INDEX IDX_A26260994B52E5B5 (museum_id), PRIMARY KEY(oeuvre_id, museum_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre_artiste ADD CONSTRAINT FK_DB75DF1488194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_artiste ADD CONSTRAINT FK_DB75DF1421D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_museum ADD CONSTRAINT FK_A262609988194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_museum ADD CONSTRAINT FK_A26260994B52E5B5 FOREIGN KEY (museum_id) REFERENCES museum (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE oeuvre_artiste');
        $this->addSql('DROP TABLE oeuvre_museum');
    }
}
