<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106151908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intsy_projet ADD hebergement_id INT NOT NULL');
        $this->addSql('ALTER TABLE intsy_projet ADD CONSTRAINT FK_7D55D9D523BB0F66 FOREIGN KEY (hebergement_id) REFERENCES intsy_hebergement (id)');
        $this->addSql('CREATE INDEX IDX_7D55D9D523BB0F66 ON intsy_projet (hebergement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intsy_projet DROP FOREIGN KEY FK_7D55D9D523BB0F66');
        $this->addSql('DROP INDEX IDX_7D55D9D523BB0F66 ON intsy_projet');
        $this->addSql('ALTER TABLE intsy_projet DROP hebergement_id');
    }
}
