<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423122622 extends AbstractMigration
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
        $this->addSql('ALTER TABLE app_user ADD username_canonical VARCHAR(180) NOT NULL, ADD email_canonical VARCHAR(180) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) DEFAULT NULL, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP role_user, DROP image_profil, DROP image_banniere, CHANGE username username VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE age age SMALLINT NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E992FC23A8 ON app_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9A0D96FBF ON app_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9C05FB297 ON app_user (confirmation_token)');
        $this->addSql('ALTER TABLE artiste ADD century SMALLINT DEFAULT NULL, ADD slug VARCHAR(32) NOT NULL, DROP century_artiste, CHANGE name_artiste name_artist VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4A3353D8');
        $this->addSql('DROP INDEX IDX_9474526C4A3353D8 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE app_user_id appuser_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBB5E5996 FOREIGN KEY (appuser_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CBB5E5996 ON comment (appuser_id)');
        $this->addSql('ALTER TABLE museum ADD slug VARCHAR(32) NOT NULL, CHANGE name_museum name_museum VARCHAR(125) NOT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD date_art DATE DEFAULT NULL, ADD description_art LONGTEXT DEFAULT NULL, ADD information_art LONGTEXT DEFAULT NULL, ADD slug VARCHAR(32) NOT NULL, DROP date, DROP description, DROP information, CHANGE name_art name_art VARCHAR(160) NOT NULL, CHANGE image_art image_art VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE oeuvre_artiste');
        $this->addSql('DROP TABLE oeuvre_museum');
        $this->addSql('DROP INDEX UNIQ_88BDF3E992FC23A8 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9A0D96FBF ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9C05FB297 ON app_user');
        $this->addSql('ALTER TABLE app_user ADD role_user VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, ADD image_banniere VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP username_canonical, DROP email_canonical, DROP enabled, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles, CHANGE username username VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE age age INT NOT NULL, CHANGE salt image_profil VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE artiste ADD century_artiste SMALLINT NOT NULL, DROP century, DROP slug, CHANGE name_artist name_artiste VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBB5E5996');
        $this->addSql('DROP INDEX IDX_9474526CBB5E5996 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE appuser_id app_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4A3353D8 FOREIGN KEY (app_user_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C4A3353D8 ON comment (app_user_id)');
        $this->addSql('ALTER TABLE museum DROP slug, CHANGE name_museum name_museum VARCHAR(160) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE oeuvre ADD date DATETIME DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD information LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP date_art, DROP description_art, DROP information_art, DROP slug, CHANGE name_art name_art VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE image_art image_art VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
