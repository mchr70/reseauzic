<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190227102958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_sender_id INT NOT NULL, user_recipient_id INT NOT NULL, thread_id INT NOT NULL, timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, text LONGTEXT NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_B6BD307FF6C43E79 (user_sender_id), INDEX IDX_B6BD307F69E3F37A (user_recipient_id), INDEX IDX_B6BD307FE2904019 (thread_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_14B78418A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, user_sender_id INT NOT NULL, user_recipient_id INT NOT NULL, note SMALLINT NOT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D8892622F6C43E79 (user_sender_id), INDEX IDX_D889262269E3F37A (user_recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thread (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, photo_id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birth_date DATE DEFAULT NULL, registration_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, gender TINYINT(1) DEFAULT NULL, zip_code VARCHAR(64) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, about LONGTEXT DEFAULT NULL, influences LONGTEXT DEFAULT NULL, material LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6497E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_genre (user_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_6192C8A0A76ED395 (user_id), INDEX IDX_6192C8A04296D31F (genre_id), PRIMARY KEY(user_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_instrument (user_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_9BD8AF31A76ED395 (user_id), INDEX IDX_9BD8AF31CF11D9C (instrument_id), PRIMARY KEY(user_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F69E3F37A FOREIGN KEY (user_recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622F6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262269E3F37A FOREIGN KEY (user_recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE user_genre ADD CONSTRAINT FK_6192C8A0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_genre ADD CONSTRAINT FK_6192C8A04296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instrument ADD CONSTRAINT FK_9BD8AF31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instrument ADD CONSTRAINT FK_9BD8AF31CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_genre DROP FOREIGN KEY FK_6192C8A04296D31F');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31CF11D9C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497E9E4C8C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE2904019');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF6C43E79');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F69E3F37A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622F6C43E79');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262269E3F37A');
        $this->addSql('ALTER TABLE user_genre DROP FOREIGN KEY FK_6192C8A0A76ED395');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31A76ED395');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE thread');
        $this->addSql('DROP TABLE upload');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_genre');
        $this->addSql('DROP TABLE user_instrument');
    }
}
