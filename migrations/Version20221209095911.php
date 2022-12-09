<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209095911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE draw ADD student_id INT NOT NULL');
        $this->addSql('ALTER TABLE draw ADD CONSTRAINT FK_70F2BD0FCB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_70F2BD0FCB944F1A ON draw (student_id)');
        $this->addSql('ALTER TABLE sheet ADD draw_sheet_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2CF5B6953 FOREIGN KEY (draw_sheet_id) REFERENCES draw (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_873C91E2CF5B6953 ON sheet (draw_sheet_id)');
        $this->addSql('ALTER TABLE signature ADD student_id INT DEFAULT NULL, ADD teacher_id INT DEFAULT NULL, ADD sheet_id INT NOT NULL');
        $this->addSql('ALTER TABLE signature ADD CONSTRAINT FK_AE880141CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE signature ADD CONSTRAINT FK_AE88014141807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE signature ADD CONSTRAINT FK_AE8801418B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id)');
        $this->addSql('CREATE INDEX IDX_AE880141CB944F1A ON signature (student_id)');
        $this->addSql('CREATE INDEX IDX_AE88014141807E1D ON signature (teacher_id)');
        $this->addSql('CREATE INDEX IDX_AE8801418B1206A5 ON signature (sheet_id)');
        $this->addSql('ALTER TABLE user ADD classroom_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496278D5A8 ON user (classroom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE draw DROP FOREIGN KEY FK_70F2BD0FCB944F1A');
        $this->addSql('DROP INDEX IDX_70F2BD0FCB944F1A ON draw');
        $this->addSql('ALTER TABLE draw DROP student_id');
        $this->addSql('ALTER TABLE sheet DROP FOREIGN KEY FK_873C91E2CF5B6953');
        $this->addSql('DROP INDEX UNIQ_873C91E2CF5B6953 ON sheet');
        $this->addSql('ALTER TABLE sheet DROP draw_sheet_id');
        $this->addSql('ALTER TABLE signature DROP FOREIGN KEY FK_AE880141CB944F1A');
        $this->addSql('ALTER TABLE signature DROP FOREIGN KEY FK_AE88014141807E1D');
        $this->addSql('ALTER TABLE signature DROP FOREIGN KEY FK_AE8801418B1206A5');
        $this->addSql('DROP INDEX IDX_AE880141CB944F1A ON signature');
        $this->addSql('DROP INDEX IDX_AE88014141807E1D ON signature');
        $this->addSql('DROP INDEX IDX_AE8801418B1206A5 ON signature');
        $this->addSql('ALTER TABLE signature DROP student_id, DROP teacher_id, DROP sheet_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496278D5A8');
        $this->addSql('DROP INDEX IDX_8D93D6496278D5A8 ON user');
        $this->addSql('ALTER TABLE user DROP classroom_id');
    }
}
