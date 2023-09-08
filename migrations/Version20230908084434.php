<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908084434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE compteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE concession_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE marque_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE modele_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE suivi_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vehicule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE view_update_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, code VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(20) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE compteur (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE concession (id INT NOT NULL, region_id INT DEFAULT NULL, code_interne VARCHAR(20) NOT NULL, libelle_affichage VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B517BD9D98260155 ON concession (region_id)');
        $this->addSql('CREATE TABLE concession_marque (concession_id INT NOT NULL, marque_id INT NOT NULL, PRIMARY KEY(concession_id, marque_id))');
        $this->addSql('CREATE INDEX IDX_737B94204132BB14 ON concession_marque (concession_id)');
        $this->addSql('CREATE INDEX IDX_737B94204827B9B2 ON concession_marque (marque_id)');
        $this->addSql('CREATE TABLE marque (id INT NOT NULL, code VARCHAR(30) NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE modele (id INT NOT NULL, marque_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_100285584827B9B2 ON modele (marque_id)');
        $this->addSql('CREATE TABLE option (id INT NOT NULL, marque_id INT NOT NULL, code VARCHAR(10) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8600B04827B9B2 ON option (marque_id)');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, vehicule_id INT NOT NULL, client_id INT NOT NULL, date_demande DATE NOT NULL, en_cours BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C849554A4A3511 ON reservation (vehicule_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE TABLE suivi_commande (id INT NOT NULL, date_commande DATE NOT NULL, date_reception_commande DATE DEFAULT NULL, date_debut_construction DATE DEFAULT NULL, date_fin_construction DATE DEFAULT NULL, date_depart_usine DATE DEFAULT NULL, date_reception_concession DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE vehicule (id INT NOT NULL, categorie_id INT NOT NULL, concession_id INT NOT NULL, marque_id INT NOT NULL, suivi_commande_id INT NOT NULL, modele_id INT NOT NULL, state VARCHAR(50) NOT NULL, car VARCHAR(10) NOT NULL, vin VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_292FFF1DBCF5E72D ON vehicule (categorie_id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D4132BB14 ON vehicule (concession_id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D4827B9B2 ON vehicule (marque_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_292FFF1D53FB2A49 ON vehicule (suivi_commande_id)');
        $this->addSql('CREATE INDEX IDX_292FFF1DAC14B70A ON vehicule (modele_id)');
        $this->addSql('CREATE TABLE vehicule_option (vehicule_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(vehicule_id, option_id))');
        $this->addSql('CREATE INDEX IDX_DFD3E9904A4A3511 ON vehicule_option (vehicule_id)');
        $this->addSql('CREATE INDEX IDX_DFD3E990A7C41D6F ON vehicule_option (option_id)');
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
        $this->addSql('ALTER TABLE concession ADD CONSTRAINT FK_B517BD9D98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE concession_marque ADD CONSTRAINT FK_737B94204132BB14 FOREIGN KEY (concession_id) REFERENCES concession (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE concession_marque ADD CONSTRAINT FK_737B94204827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE option ADD CONSTRAINT FK_5A8600B04827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D4132BB14 FOREIGN KEY (concession_id) REFERENCES concession (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D53FB2A49 FOREIGN KEY (suivi_commande_id) REFERENCES suivi_commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule_option ADD CONSTRAINT FK_DFD3E9904A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicule_option ADD CONSTRAINT FK_DFD3E990A7C41D6F FOREIGN KEY (option_id) REFERENCES option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE compteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE concession_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE marque_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE modele_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE suivi_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vehicule_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE view_update_list_id_seq CASCADE');
        $this->addSql('ALTER TABLE concession DROP CONSTRAINT FK_B517BD9D98260155');
        $this->addSql('ALTER TABLE concession_marque DROP CONSTRAINT FK_737B94204132BB14');
        $this->addSql('ALTER TABLE concession_marque DROP CONSTRAINT FK_737B94204827B9B2');
        $this->addSql('ALTER TABLE modele DROP CONSTRAINT FK_100285584827B9B2');
        $this->addSql('ALTER TABLE option DROP CONSTRAINT FK_5A8600B04827B9B2');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849554A4A3511');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1DBCF5E72D');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1D4132BB14');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1D4827B9B2');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1D53FB2A49');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1DAC14B70A');
        $this->addSql('ALTER TABLE vehicule_option DROP CONSTRAINT FK_DFD3E9904A4A3511');
        $this->addSql('ALTER TABLE vehicule_option DROP CONSTRAINT FK_DFD3E990A7C41D6F');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE concession');
        $this->addSql('DROP TABLE concession_marque');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE option');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE suivi_commande');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE vehicule_option');
        $this->addSql('DROP TABLE view_update_list');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
