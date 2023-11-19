<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119110622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // ... (autres modifications)
    
        // Ajouter une requête SQL pour ajouter la colonne id dans ville
        $this->addSql('ALTER TABLE ville ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
    }
}
