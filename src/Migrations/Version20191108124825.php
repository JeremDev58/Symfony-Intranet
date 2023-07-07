<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108124825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intsy_hebergement CHANGE nic_admin nic_admin VARCHAR(255) DEFAULT NULL, CHANGE nic_admin_pwd nic_admin_pwd VARCHAR(255) DEFAULT NULL, CHANGE nic_tech nic_tech VARCHAR(255) DEFAULT NULL, CHANGE nic_tech_pwd nic_tech_pwd VARCHAR(255) DEFAULT NULL, CHANGE nic_prop nic_prop VARCHAR(255) DEFAULT NULL, CHANGE nic_prop_pwd nic_prop_pwd VARCHAR(255) DEFAULT NULL, CHANGE ftp_id ftp_id VARCHAR(255) DEFAULT NULL, CHANGE ftp_pass ftp_pass VARCHAR(255) DEFAULT NULL, CHANGE mysql_id mysql_id VARCHAR(255) DEFAULT NULL, CHANGE mysql_pass mysql_pass VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intsy_hebergement CHANGE nic_admin nic_admin VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE nic_admin_pwd nic_admin_pwd VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE nic_tech nic_tech VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE nic_tech_pwd nic_tech_pwd VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE nic_prop nic_prop VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE nic_prop_pwd nic_prop_pwd VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE ftp_id ftp_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE ftp_pass ftp_pass VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE mysql_id mysql_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE mysql_pass mysql_pass VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
