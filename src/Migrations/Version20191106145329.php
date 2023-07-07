<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106145329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE intsy_domaine (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, client_id INT NOT NULL, titre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2131779EC18272 (projet_id), INDEX IDX_2131779E19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intsy_domaine ADD CONSTRAINT FK_2131779EC18272 FOREIGN KEY (projet_id) REFERENCES intsy_projet (id)');
        $this->addSql('ALTER TABLE intsy_domaine ADD CONSTRAINT FK_2131779E19EB6921 FOREIGN KEY (client_id) REFERENCES intsy_client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE intsy_domaine');
    }
}
