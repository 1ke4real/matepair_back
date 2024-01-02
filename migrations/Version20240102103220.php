<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240102103220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE encounter_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE encounter (id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE encounter_user (encounter_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(encounter_id, user_id))');
        $this->addSql('CREATE INDEX IDX_941B872CD6E2FADC ON encounter_user (encounter_id)');
        $this->addSql('CREATE INDEX IDX_941B872CA76ED395 ON encounter_user (user_id)');
        $this->addSql('ALTER TABLE encounter_user ADD CONSTRAINT FK_941B872CD6E2FADC FOREIGN KEY (encounter_id) REFERENCES encounter (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE encounter_user ADD CONSTRAINT FK_941B872CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE encounter_id_seq CASCADE');
        $this->addSql('ALTER TABLE encounter_user DROP CONSTRAINT FK_941B872CD6E2FADC');
        $this->addSql('ALTER TABLE encounter_user DROP CONSTRAINT FK_941B872CA76ED395');
        $this->addSql('DROP TABLE encounter');
        $this->addSql('DROP TABLE encounter_user');
    }
}
