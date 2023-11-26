<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126104211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE ad DROP ville_id');
        $this->addSql('ALTER TABLE departement DROP test');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, code_departement VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, nom VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, code_postal VARCHAR(250) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ad ADD ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departement ADD test VARCHAR(255) NOT NULL');
    }
}
