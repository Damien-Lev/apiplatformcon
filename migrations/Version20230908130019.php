<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908130019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $nextVal = $this->connection->executeQuery('SELECT nextval(\'compteur_id_seq\')')->fetchAllAssociative()[0]['nextval'];
        $this->connection->executeQuery('INSERT INTO compteur (id, name) VALUES ('.$nextVal.',\'en_commande\')');
        $nextVal = $this->connection->executeQuery('SELECT nextval(\'compteur_id_seq\')')->fetchAllAssociative()[0]['nextval'];
        $this->connection->executeQuery('INSERT INTO compteur (id, name) VALUES ('.$nextVal.',\'en_stock\')');
        $nextVal = $this->connection->executeQuery('SELECT nextval(\'compteur_id_seq\')')->fetchAllAssociative()[0]['nextval'];
        $this->connection->executeQuery('INSERT INTO compteur (id, name) VALUES ('.$nextVal.',\'reserve\')');
        $nextVal = $this->connection->executeQuery('SELECT nextval(\'compteur_id_seq\')')->fetchAllAssociative()[0]['nextval'];
        $this->connection->executeQuery('INSERT INTO compteur (id, name) VALUES ('.$nextVal.',\'vendu\')');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
