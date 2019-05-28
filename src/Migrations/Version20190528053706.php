<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528053706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, descr VARCHAR(1200) NOT NULL, status SMALLINT NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD title VARCHAR(255) NOT NULL, ADD descr VARCHAR(1200) NOT NULL, ADD status SMALLINT NOT NULL, ADD created DATETIME NOT NULL, CHANGE username username VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE notes');
        $this->addSql('ALTER TABLE user DROP title, DROP descr, DROP status, DROP created, CHANGE username username VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE roles roles INT NOT NULL, CHANGE password password VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
