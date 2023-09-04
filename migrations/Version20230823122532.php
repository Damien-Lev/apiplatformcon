<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823122532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE joueur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lobby_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resultat_partie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE saison_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE view_update_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE joueur (id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE joueur_saison (joueur_id INT NOT NULL, saison_id INT NOT NULL, PRIMARY KEY(joueur_id, saison_id))');
        $this->addSql('CREATE INDEX IDX_296BC50AA9E2D76C ON joueur_saison (joueur_id)');
        $this->addSql('CREATE INDEX IDX_296BC50AF965414C ON joueur_saison (saison_id)');
        $this->addSql('CREATE TABLE lobby (id INT NOT NULL, partie_id INT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CCE455F7E075F7A4 ON lobby (partie_id)');
        $this->addSql('CREATE TABLE manche (id INT NOT NULL, saison_id INT NOT NULL, date DATE NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A06E62EBF965414C ON manche (saison_id)');
        $this->addSql('CREATE TABLE partie (id INT NOT NULL, manche_id INT NOT NULL, ordre INT NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_59B1F3D3E37BFAB ON partie (manche_id)');
        $this->addSql('CREATE TABLE resultat_partie (id INT NOT NULL, lobby_id INT NOT NULL, joueur_id INT NOT NULL, place INT DEFAULT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D0A6360B6612FD9 ON resultat_partie (lobby_id)');
        $this->addSql('CREATE INDEX IDX_6D0A6360A9E2D76C ON resultat_partie (joueur_id)');
        $this->addSql('CREATE TABLE saison (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE view_update_list (id INT NOT NULL, view_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE joueur_saison ADD CONSTRAINT FK_296BC50AA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE joueur_saison ADD CONSTRAINT FK_296BC50AF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lobby ADD CONSTRAINT FK_CCE455F7E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manche ADD CONSTRAINT FK_A06E62EBF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D3E37BFAB FOREIGN KEY (manche_id) REFERENCES manche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resultat_partie ADD CONSTRAINT FK_6D0A6360B6612FD9 FOREIGN KEY (lobby_id) REFERENCES lobby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resultat_partie ADD CONSTRAINT FK_6D0A6360A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE joueur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lobby_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resultat_partie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE saison_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE view_update_list_id_seq CASCADE');
        $this->addSql('ALTER TABLE joueur_saison DROP CONSTRAINT FK_296BC50AA9E2D76C');
        $this->addSql('ALTER TABLE joueur_saison DROP CONSTRAINT FK_296BC50AF965414C');
        $this->addSql('ALTER TABLE lobby DROP CONSTRAINT FK_CCE455F7E075F7A4');
        $this->addSql('ALTER TABLE manche DROP CONSTRAINT FK_A06E62EBF965414C');
        $this->addSql('ALTER TABLE partie DROP CONSTRAINT FK_59B1F3D3E37BFAB');
        $this->addSql('ALTER TABLE resultat_partie DROP CONSTRAINT FK_6D0A6360B6612FD9');
        $this->addSql('ALTER TABLE resultat_partie DROP CONSTRAINT FK_6D0A6360A9E2D76C');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE joueur_saison');
        $this->addSql('DROP TABLE lobby');
        $this->addSql('DROP TABLE manche');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE resultat_partie');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE view_update_list');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
