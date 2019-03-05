<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305125435 extends AbstractMigration
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
        $this->addSql('DROP TABLE thread_user');
        $this->addSql('ALTER TABLE thread ADD user_creator_id INT NOT NULL, ADD user_recipient_id INT NOT NULL');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83C645C84A FOREIGN KEY (user_creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C8369E3F37A FOREIGN KEY (user_recipient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_31204C83C645C84A ON thread (user_creator_id)');
        $this->addSql('CREATE INDEX IDX_31204C8369E3F37A ON thread (user_recipient_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrumentallevelbyuser_instrument (instrumentallevelbyuser_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_53FAB1BE595A67DE (instrumentallevelbyuser_id), INDEX IDX_53FAB1BECF11D9C (instrument_id), PRIMARY KEY(instrumentallevelbyuser_id, instrument_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_level (instrumentallevelbyuser_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_A5FACA9D595A67DE (instrumentallevelbyuser_id), INDEX IDX_A5FACA9D5FB14BA7 (level_id), PRIMARY KEY(instrumentallevelbyuser_id, level_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_user (instrumentallevelbyuser_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_289385EF595A67DE (instrumentallevelbyuser_id), INDEX IDX_289385EFA76ED395 (user_id), PRIMARY KEY(instrumentallevelbyuser_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE thread_user (thread_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_922CAC7E2904019 (thread_id), INDEX IDX_922CAC7A76ED395 (user_id), PRIMARY KEY(thread_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE thread_user ADD CONSTRAINT FK_922CAC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thread_user ADD CONSTRAINT FK_922CAC7E2904019 FOREIGN KEY (thread_id) REFERENCES thread (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83C645C84A');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C8369E3F37A');
        $this->addSql('DROP INDEX IDX_31204C83C645C84A ON thread');
        $this->addSql('DROP INDEX IDX_31204C8369E3F37A ON thread');
        $this->addSql('ALTER TABLE thread DROP user_creator_id, DROP user_recipient_id');
    }
}
