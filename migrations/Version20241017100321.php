<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017100321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibilite (id INT AUTO_INCREMENT NOT NULL, benevole_id INT NOT NULL, jours_disponibles VARCHAR(255) NOT NULL, heures_disponibles VARCHAR(255) NOT NULL, INDEX IDX_2CBACE2FE77B7C09 (benevole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, benevole_id INT NOT NULL, projet_id INT NOT NULL, date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5E90F6D6E77B7C09 (benevole_id), INDEX IDX_5E90F6D6C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_9067F23CC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_benevole (mission_id INT NOT NULL, benevole_id INT NOT NULL, INDEX IDX_BCFD4E62BE6CAE90 (mission_id), INDEX IDX_BCFD4E62E77B7C09 (benevole_id), PRIMARY KEY(mission_id, benevole_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, benevole_id INT NOT NULL, message VARCHAR(255) NOT NULL, date_notification DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BF5476CAE77B7C09 (benevole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, association_id INT NOT NULL, zone_id INT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_fin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_benevoles_necessaires INT NOT NULL, INDEX IDX_50159CA9EFB9C8A5 (association_id), INDEX IDX_50159CA99F2C3FAB (zone_id), INDEX IDX_50159CA9BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_passe VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE benevole_zone (benevole_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_41F7B7B4E77B7C09 (benevole_id), INDEX IDX_41F7B7B49F2C3FAB (zone_id), PRIMARY KEY(benevole_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT FK_2CBACE2FE77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE mission_benevole ADD CONSTRAINT FK_BCFD4E62BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_benevole ADD CONSTRAINT FK_BCFD4E62E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9EFB9C8A5 FOREIGN KEY (association_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA99F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B4E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B49F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2FE77B7C09');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6E77B7C09');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6C18272');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CC18272');
        $this->addSql('ALTER TABLE mission_benevole DROP FOREIGN KEY FK_BCFD4E62BE6CAE90');
        $this->addSql('ALTER TABLE mission_benevole DROP FOREIGN KEY FK_BCFD4E62E77B7C09');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE77B7C09');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9EFB9C8A5');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA99F2C3FAB');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9BCF5E72D');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B4E77B7C09');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B49F2C3FAB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_benevole');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE benevole_zone');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
