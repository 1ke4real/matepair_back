<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104140042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE demo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE encounter_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE matches_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE matches (id INT NOT NULL, first_user_id INT NOT NULL, second_user_id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62615BAB4E2BF69 ON matches (first_user_id)');
        $this->addSql('CREATE INDEX IDX_62615BAB02C53F8 ON matches (second_user_id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BAB4E2BF69 FOREIGN KEY (first_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BAB02C53F8 FOREIGN KEY (second_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE encounter_user DROP CONSTRAINT fk_941b872cd6e2fadc');
        $this->addSql('ALTER TABLE encounter_user DROP CONSTRAINT fk_941b872ca76ed395');
        $this->addSql('DROP TABLE demo');
        $this->addSql('DROP TABLE encounter');
        $this->addSql('DROP TABLE encounter_user');
        $this->addSql('ALTER TABLE message ALTER sender_id SET NOT NULL');
        $this->addSql('ALTER TABLE message ALTER receiver_id SET NOT NULL');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT fk_bf5476cabeec5bfa');
        $this->addSql('DROP INDEX idx_bf5476cabeec5bfa');
        $this->addSql('ALTER TABLE notification ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE notification ALTER content TYPE TEXT');
        $this->addSql('ALTER TABLE notification ALTER content DROP NOT NULL');
        $this->addSql('ALTER TABLE notification RENAME COLUMN user_notif_id TO user_id_id');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BF5476CA9D86650F ON notification (user_id_id)');
        $this->addSql('ALTER TABLE "user" ADD favorite_games TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD play_schedule TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ALTER username SET NOT NULL');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN detail TO details');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE matches_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE demo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE encounter_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE demo (id INT NOT NULL, test VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE encounter (id INT NOT NULL, status VARCHAR(255) DEFAULT \'waiting\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE encounter_user (encounter_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(encounter_id, user_id))');
        $this->addSql('CREATE INDEX idx_941b872ca76ed395 ON encounter_user (user_id)');
        $this->addSql('CREATE INDEX idx_941b872cd6e2fadc ON encounter_user (encounter_id)');
        $this->addSql('ALTER TABLE encounter_user ADD CONSTRAINT fk_941b872cd6e2fadc FOREIGN KEY (encounter_id) REFERENCES encounter (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE encounter_user ADD CONSTRAINT fk_941b872ca76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matches DROP CONSTRAINT FK_62615BAB4E2BF69');
        $this->addSql('ALTER TABLE matches DROP CONSTRAINT FK_62615BAB02C53F8');
        $this->addSql('DROP TABLE matches');
        $this->addSql('ALTER TABLE message ALTER sender_id DROP NOT NULL');
        $this->addSql('ALTER TABLE message ALTER receiver_id DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD detail TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" DROP details');
        $this->addSql('ALTER TABLE "user" DROP favorite_games');
        $this->addSql('ALTER TABLE "user" DROP play_schedule');
        $this->addSql('ALTER TABLE "user" ALTER username DROP NOT NULL');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CA9D86650F');
        $this->addSql('DROP INDEX IDX_BF5476CA9D86650F');
        $this->addSql('ALTER TABLE notification DROP name');
        $this->addSql('ALTER TABLE notification ALTER content TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE notification ALTER content SET NOT NULL');
        $this->addSql('ALTER TABLE notification RENAME COLUMN user_id_id TO user_notif_id');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT fk_bf5476cabeec5bfa FOREIGN KEY (user_notif_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_bf5476cabeec5bfa ON notification (user_notif_id)');
    }
}
