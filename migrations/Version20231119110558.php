<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119110558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // ... (autres modifications)
    
        // Ajouter une requête SQL pour supprimer la colonne ville_id dans ville
        $this->addSql('ALTER TABLE ad DROP ville_id');
    }
    
}
