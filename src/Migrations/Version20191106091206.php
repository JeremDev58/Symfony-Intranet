<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106091206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE intsy_projet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, chemin_local VARCHAR(255) NOT NULL, domaine_local VARCHAR(255) NOT NULL, url_admin VARCHAR(255) DEFAULT NULL, identifiant_admin VARCHAR(100) DEFAULT NULL, mdp_admin VARCHAR(100) DEFAULT NULL, nom_bdd VARCHAR(100) DEFAULT NULL, identifiant_bdd VARCHAR(100) DEFAULT NULL, mdp_bdd VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intsy_hebergement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, nic_admin VARCHAR(255) NOT NULL, nic_admin_pwd VARCHAR(255) NOT NULL, nic_tech VARCHAR(255) NOT NULL, nic_tech_pwd VARCHAR(255) NOT NULL, nic_prop VARCHAR(255) NOT NULL, nic_prop_pwd VARCHAR(255) NOT NULL, ftp_adresse VARCHAR(255) DEFAULT NULL, ftp_id VARCHAR(255) NOT NULL, ftp_p�ass VARCHAR(255) NOT NULL, mysql_adresse VARCHAR(255) DEFAULT NULL, mysql_id VARCHAR(255) NOT NULL, mysql_pass VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE intsy_projet');
        $this->addSql('DROP TABLE intsy_hebergement');
    }
}
