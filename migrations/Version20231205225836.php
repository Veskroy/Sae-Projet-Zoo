<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205225836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, name_anm VARCHAR(30) NOT NULL, gender INT DEFAULT NULL, desc_anm VARCHAR(255) DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, size DOUBLE PRECISION DEFAULT NULL, birth_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) DEFAULT NULL, date DATETIME DEFAULT NULL, hstart DATETIME DEFAULT NULL, hend DATETIME DEFAULT NULL, maxi_num_place INT DEFAULT NULL, `desc` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, name_fam VARCHAR(60) DEFAULT NULL, desc_fam VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pen (id INT AUTO_INCREMENT NOT NULL, capacity INT DEFAULT NULL, type_pen VARCHAR(50) DEFAULT NULL, size_pen DOUBLE PRECISION DEFAULT NULL, numplace INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name_spe VARCHAR(50) DEFAULT NULL, diet VARCHAR(255) DEFAULT NULL, origin VARCHAR(60) DEFAULT NULL, descspe VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, code_spot INT DEFAULT NULL, type_spot VARCHAR(10) NOT NULL, name_spot VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATETIME DEFAULT NULL, price INT DEFAULT NULL, period INT DEFAULT NULL, INDEX IDX_97A0ADA3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_event (ticket_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_139E692C700047D2 (ticket_id), INDEX IDX_139E692C71F7E88B (event_id), PRIMARY KEY(ticket_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ticket_event ADD CONSTRAINT FK_139E692C700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_event ADD CONSTRAINT FK_139E692C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('ALTER TABLE ticket_event DROP FOREIGN KEY FK_139E692C700047D2');
        $this->addSql('ALTER TABLE ticket_event DROP FOREIGN KEY FK_139E692C71F7E88B');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE pen');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE spot');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_event');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:json)\'');
    }
}
