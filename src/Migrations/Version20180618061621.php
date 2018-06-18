<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180618061621 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE history_buy_tickets (id INT AUTO_INCREMENT NOT NULL, sold_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shows (id INT AUTO_INCREMENT NOT NULL, theater_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, date DATETIME NOT NULL, description LONGTEXT NOT NULL, url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, close TINYINT(1) NOT NULL, INDEX IDX_6C3BF144D70E4479 (theater_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theaters (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, capacity INT NOT NULL, administrator INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, show_id INT DEFAULT NULL, id2 CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', status VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_54469DF47101D69E (id2), INDEX IDX_54469DF4D0C1FC64 (show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shows ADD CONSTRAINT FK_6C3BF144D70E4479 FOREIGN KEY (theater_id) REFERENCES theaters (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4D0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4D0C1FC64');
        $this->addSql('ALTER TABLE shows DROP FOREIGN KEY FK_6C3BF144D70E4479');
        $this->addSql('DROP TABLE history_buy_tickets');
        $this->addSql('DROP TABLE shows');
        $this->addSql('DROP TABLE theaters');
        $this->addSql('DROP TABLE tickets');
    }
}
