<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119112431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ville_departement ON ville');
        $this->addSql('DROP INDEX ville_nom ON ville');
        $this->addSql('DROP INDEX ville_code_postal ON ville');
        $this->addSql('ALTER TABLE ville CHANGE code_departement code_departement VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE code_postal code_postal VARCHAR(250) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville CHANGE code_departement code_departement VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE INDEX ville_departement ON ville (code_departement)');
        $this->addSql('CREATE INDEX ville_nom ON ville (nom)');
        $this->addSql('CREATE INDEX ville_code_postal ON ville (code_postal)');
    }
}
