<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180621040021 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE customers_tickets (id INTEGER NOT NULL, ticket_id INTEGER NOT NULL, solded_at DATETIME DEFAULT NULL, reserved_at DATETIME DEFAULT NULL, customer INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_680E4E11700047D2 ON customers_tickets (ticket_id)');
        $this->addSql('DROP INDEX IDX_6C3BF144D70E4479');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shows AS SELECT id, theater_id, title, artist, date, description, url, image, close FROM shows');
        $this->addSql('DROP TABLE shows');
        $this->addSql('CREATE TABLE shows (id INTEGER NOT NULL, theater_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, artist VARCHAR(255) NOT NULL COLLATE BINARY, date DATETIME NOT NULL, description CLOB NOT NULL COLLATE BINARY, url VARCHAR(255) DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, close BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_6C3BF144D70E4479 FOREIGN KEY (theater_id) REFERENCES theaters (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO shows (id, theater_id, title, artist, date, description, url, image, close) SELECT id, theater_id, title, artist, date, description, url, image, close FROM __temp__shows');
        $this->addSql('DROP TABLE __temp__shows');
        $this->addSql('CREATE INDEX IDX_6C3BF144D70E4479 ON shows (theater_id)');
        $this->addSql('DROP INDEX IDX_54469DF4D0C1FC64');
        $this->addSql('DROP INDEX UNIQ_54469DF47101D69E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tickets AS SELECT id, show_id, id2, status, price FROM tickets');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('CREATE TABLE tickets (id INTEGER NOT NULL, show_id INTEGER DEFAULT NULL, id2 CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        , status VARCHAR(50) NOT NULL COLLATE BINARY, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_54469DF4D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tickets (id, show_id, id2, status, price) SELECT id, show_id, id2, status, price FROM __temp__tickets');
        $this->addSql('DROP TABLE __temp__tickets');
        $this->addSql('CREATE INDEX IDX_54469DF4D0C1FC64 ON tickets (show_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54469DF47101D69E ON tickets (id2)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE customers_tickets');
        $this->addSql('DROP INDEX IDX_6C3BF144D70E4479');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shows AS SELECT id, theater_id, title, artist, date, description, url, image, close FROM shows');
        $this->addSql('DROP TABLE shows');
        $this->addSql('CREATE TABLE shows (id INTEGER NOT NULL, theater_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, date DATETIME NOT NULL, description CLOB NOT NULL, url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, close BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO shows (id, theater_id, title, artist, date, description, url, image, close) SELECT id, theater_id, title, artist, date, description, url, image, close FROM __temp__shows');
        $this->addSql('DROP TABLE __temp__shows');
        $this->addSql('CREATE INDEX IDX_6C3BF144D70E4479 ON shows (theater_id)');
        $this->addSql('DROP INDEX UNIQ_54469DF47101D69E');
        $this->addSql('DROP INDEX IDX_54469DF4D0C1FC64');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tickets AS SELECT id, show_id, id2, status, price FROM tickets');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('CREATE TABLE tickets (id INTEGER NOT NULL, show_id INTEGER DEFAULT NULL, id2 CHAR(36) NOT NULL --(DC2Type:guid)
        , status VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO tickets (id, show_id, id2, status, price) SELECT id, show_id, id2, status, price FROM __temp__tickets');
        $this->addSql('DROP TABLE __temp__tickets');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54469DF47101D69E ON tickets (id2)');
        $this->addSql('CREATE INDEX IDX_54469DF4D0C1FC64 ON tickets (show_id)');
    }
}
