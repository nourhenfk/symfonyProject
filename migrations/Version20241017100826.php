<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017100826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE benevole (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benevole ADD CONSTRAINT FK_B4014FDBBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B4E77B7C09');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B4E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2FE77B7C09');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT FK_2CBACE2FE77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6E77B7C09');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id)');
        $this->addSql('ALTER TABLE mission_benevole DROP FOREIGN KEY FK_BCFD4E62E77B7C09');
        $this->addSql('ALTER TABLE mission_benevole ADD CONSTRAINT FK_BCFD4E62E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE77B7C09');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id)');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9EFB9C8A5');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9EFB9C8A5');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B4E77B7C09');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2FE77B7C09');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6E77B7C09');
        $this->addSql('ALTER TABLE mission_benevole DROP FOREIGN KEY FK_BCFD4E62E77B7C09');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE77B7C09');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCBF396750');
        $this->addSql('ALTER TABLE benevole DROP FOREIGN KEY FK_B4014FDBBF396750');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE benevole');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B4E77B7C09');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B4E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2FE77B7C09');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT FK_2CBACE2FE77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6E77B7C09');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE mission_benevole DROP FOREIGN KEY FK_BCFD4E62E77B7C09');
        $this->addSql('ALTER TABLE mission_benevole ADD CONSTRAINT FK_BCFD4E62E77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE77B7C09');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE77B7C09 FOREIGN KEY (benevole_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9EFB9C8A5');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9EFB9C8A5 FOREIGN KEY (association_id) REFERENCES utilisateur (id)');
    }
}
