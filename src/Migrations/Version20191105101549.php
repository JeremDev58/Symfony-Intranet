<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105101549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE intsy_client (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, siret VARCHAR(255) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_EA044129BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intsy_contact (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, poste VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, portable VARCHAR(255) DEFAULT NULL, INDEX IDX_15FC9B6A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intsy_client ADD CONSTRAINT FK_EA044129BCF5E72D FOREIGN KEY (categorie_id) REFERENCES intsy_categorie (id)');
        $this->addSql('ALTER TABLE intsy_contact ADD CONSTRAINT FK_15FC9B6A19EB6921 FOREIGN KEY (client_id) REFERENCES intsy_client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intsy_contact DROP FOREIGN KEY FK_15FC9B6A19EB6921');
        $this->addSql('DROP TABLE intsy_client');
        $this->addSql('DROP TABLE intsy_contact');
    }
}
