<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313061844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abs_etudiant (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, img_just VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_64538447DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abs_prof (id INT AUTO_INCREMENT NOT NULL, prof_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2841AA52ABC1F7FE (prof_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dep_ant_etudiant (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, temp_dep DATETIME NOT NULL, temp_arr DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_43A7EBAADDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dep_ant_prof (id INT AUTO_INCREMENT NOT NULL, prof_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, temp_dep DATETIME NOT NULL, temp_arr DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_BD668FAAABC1F7FE (prof_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, grade VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_717E22E3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, prof_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, INDEX IDX_C242628ABC1F7FE (prof_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5BBA70BBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retard_etudiant (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, temp_cours DATETIME NOT NULL, temp_arr DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_7F3883FEDDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retard_prof (id INT AUTO_INCREMENT NOT NULL, prof_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, temp_ens DATETIME NOT NULL, temp_arr DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_6326DCE5ABC1F7FE (prof_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abs_etudiant ADD CONSTRAINT FK_64538447DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE abs_prof ADD CONSTRAINT FK_2841AA52ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id)');
        $this->addSql('ALTER TABLE dep_ant_etudiant ADD CONSTRAINT FK_43A7EBAADDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE dep_ant_prof ADD CONSTRAINT FK_BD668FAAABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id)');
        $this->addSql('ALTER TABLE retard_etudiant ADD CONSTRAINT FK_7F3883FEDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE retard_prof ADD CONSTRAINT FK_6326DCE5ABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abs_etudiant DROP FOREIGN KEY FK_64538447DDEAB1A3');
        $this->addSql('ALTER TABLE dep_ant_etudiant DROP FOREIGN KEY FK_43A7EBAADDEAB1A3');
        $this->addSql('ALTER TABLE retard_etudiant DROP FOREIGN KEY FK_7F3883FEDDEAB1A3');
        $this->addSql('ALTER TABLE abs_prof DROP FOREIGN KEY FK_2841AA52ABC1F7FE');
        $this->addSql('ALTER TABLE dep_ant_prof DROP FOREIGN KEY FK_BD668FAAABC1F7FE');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628ABC1F7FE');
        $this->addSql('ALTER TABLE retard_prof DROP FOREIGN KEY FK_6326DCE5ABC1F7FE');
        $this->addSql('DROP TABLE abs_etudiant');
        $this->addSql('DROP TABLE abs_prof');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE dep_ant_etudiant');
        $this->addSql('DROP TABLE dep_ant_prof');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE prof');
        $this->addSql('DROP TABLE retard_etudiant');
        $this->addSql('DROP TABLE retard_prof');
    }
}
