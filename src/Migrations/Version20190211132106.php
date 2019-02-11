<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211132106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrumentallevelbyuser_user (instrumentallevelbyuser_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_289385EF595A67DE (instrumentallevelbyuser_id), INDEX IDX_289385EFA76ED395 (user_id), PRIMARY KEY(instrumentallevelbyuser_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_level (instrumentallevelbyuser_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_A5FACA9D595A67DE (instrumentallevelbyuser_id), INDEX IDX_A5FACA9D5FB14BA7 (level_id), PRIMARY KEY(instrumentallevelbyuser_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrumentallevelbyuser_instrument (instrumentallevelbyuser_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_53FAB1BE595A67DE (instrumentallevelbyuser_id), INDEX IDX_53FAB1BECF11D9C (instrument_id), PRIMARY KEY(instrumentallevelbyuser_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_user ADD CONSTRAINT FK_289385EF595A67DE FOREIGN KEY (instrumentallevelbyuser_id) REFERENCES instrumentallevelbyuser (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_user ADD CONSTRAINT FK_289385EFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_level ADD CONSTRAINT FK_A5FACA9D595A67DE FOREIGN KEY (instrumentallevelbyuser_id) REFERENCES instrumentallevelbyuser (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_level ADD CONSTRAINT FK_A5FACA9D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_instrument ADD CONSTRAINT FK_53FAB1BE595A67DE FOREIGN KEY (instrumentallevelbyuser_id) REFERENCES instrumentallevelbyuser (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrumentallevelbyuser_instrument ADD CONSTRAINT FK_53FAB1BECF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrumentallevelbyuser_user');
        $this->addSql('DROP TABLE instrumentallevelbyuser_level');
        $this->addSql('DROP TABLE instrumentallevelbyuser_instrument');
    }
}
