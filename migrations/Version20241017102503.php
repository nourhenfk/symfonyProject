<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017102503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association ADD secteur_activite VARCHAR(255) NOT NULL, ADD statut_juridique VARCHAR(255) NOT NULL, ADD site_web VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE benevole ADD prenom VARCHAR(255) NOT NULL, ADD date_naissance VARCHAR(255) NOT NULL, ADD experience VARCHAR(255) NOT NULL, ADD skills VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD adresse VARCHAR(255) NOT NULL, CHANGE prenom numtel VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association DROP secteur_activite, DROP statut_juridique, DROP site_web');
        $this->addSql('ALTER TABLE benevole DROP prenom, DROP date_naissance, DROP experience, DROP skills');
        $this->addSql('ALTER TABLE utilisateur ADD prenom VARCHAR(255) NOT NULL, DROP numtel, DROP adresse');
    }
}
