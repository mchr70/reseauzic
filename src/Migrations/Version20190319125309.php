<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190319125309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birth_date DATE DEFAULT NULL, registration_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, gender TINYINT(1) DEFAULT NULL, zip_code VARCHAR(64) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, about LONGTEXT DEFAULT NULL, influences LONGTEXT DEFAULT NULL, material LONGTEXT DEFAULT NULL, photo_src VARCHAR(255) DEFAULT NULL, photo_alt VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF6C43E79');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F69E3F37A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622F6C43E79');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262269E3F37A');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83C645C84A');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C8369E3F37A');
        $this->addSql('ALTER TABLE user_genre DROP FOREIGN KEY FK_6192C8A0A76ED395');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31A76ED395');
        $this->addSql('DROP TABLE user');
    }
}
