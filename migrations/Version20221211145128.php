<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211145128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animation (id INT AUTO_INCREMENT NOT NULL, teacher_id INT NOT NULL, classroom_id INT DEFAULT NULL, class_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', skills LONGTEXT DEFAULT NULL, subject VARCHAR(255) NOT NULL, INDEX IDX_8D5284DC41807E1D (teacher_id), INDEX IDX_8D5284DC6278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE draw (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, sheet_id INT NOT NULL, to_search_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', searched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', step_count INT DEFAULT NULL, ceated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_70F2BD0FCB944F1A (student_id), UNIQUE INDEX UNIQ_70F2BD0F8B1206A5 (sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, sheet_id INT NOT NULL, INDEX IDX_6977C7A58B1206A5 (sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sheet (id INT AUTO_INCREMENT NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', week INT NOT NULL, ceated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signature (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, presence_id INT DEFAULT NULL, signed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', comment VARCHAR(255) DEFAULT NULL, INDEX IDX_AE880141A76ED395 (user_id), INDEX IDX_AE880141F328FFC4 (presence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, classroom_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animation ADD CONSTRAINT FK_8D5284DC41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE animation ADD CONSTRAINT FK_8D5284DC6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE draw ADD CONSTRAINT FK_70F2BD0FCB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE draw ADD CONSTRAINT FK_70F2BD0F8B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A58B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id)');
        $this->addSql('ALTER TABLE signature ADD CONSTRAINT FK_AE880141A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE signature ADD CONSTRAINT FK_AE880141F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animation DROP FOREIGN KEY FK_8D5284DC41807E1D');
        $this->addSql('ALTER TABLE animation DROP FOREIGN KEY FK_8D5284DC6278D5A8');
        $this->addSql('ALTER TABLE draw DROP FOREIGN KEY FK_70F2BD0FCB944F1A');
        $this->addSql('ALTER TABLE draw DROP FOREIGN KEY FK_70F2BD0F8B1206A5');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A58B1206A5');
        $this->addSql('ALTER TABLE signature DROP FOREIGN KEY FK_AE880141A76ED395');
        $this->addSql('ALTER TABLE signature DROP FOREIGN KEY FK_AE880141F328FFC4');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496278D5A8');
        $this->addSql('DROP TABLE animation');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE draw');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE sheet');
        $this->addSql('DROP TABLE signature');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
