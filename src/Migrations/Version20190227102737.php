<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190227102737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrumentallevelbyuser_instrument');
        $this->addSql('DROP TABLE instrumentallevelbyuser_level');
        $this->addSql('DROP TABLE instrumentallevelbyuser_user');
        $this->addSql('DROP TABLE level');
        $this->addSql('ALTER TABLE user ADD photo_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497E9E4C8C ON user (photo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrumentallevelbyuser_instrument (instrumentallevelbyuser_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_53FAB1BE595A67DE (instrumentallevelbyuser_id), INDEX IDX_53FAB1BECF11D9C (instrument_id), PRIMARY KEY(instrumentallevelbyuser_id, instrument_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_level (instrumentallevelbyuser_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_A5FACA9D595A67DE (instrumentallevelbyuser_id), INDEX IDX_A5FACA9D5FB14BA7 (level_id), PRIMARY KEY(instrumentallevelbyuser_id, level_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_user (instrumentallevelbyuser_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_289385EF595A67DE (instrumentallevelbyuser_id), INDEX IDX_289385EFA76ED395 (user_id), PRIMARY KEY(instrumentallevelbyuser_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_8D93D6497E9E4C8C ON user');
        $this->addSql('ALTER TABLE user DROP photo_id');
    }
}
