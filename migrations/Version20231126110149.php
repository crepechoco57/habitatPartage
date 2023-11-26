<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126110149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, code_departement VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, code_postal VARCHAR(250) NOT NULL, arrondissement SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE villes_france_free');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE villes_france_free (id INT UNSIGNED AUTO_INCREMENT NOT NULL, code_departement VARCHAR(3) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, nom VARCHAR(45) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, code_postal VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, arrondissement SMALLINT UNSIGNED DEFAULT NULL, INDEX ville_departement (code_departement), INDEX ville_nom (nom), INDEX ville_code_postal (code_postal), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE ville');
    }
}
