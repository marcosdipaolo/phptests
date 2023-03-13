<?php

declare(strict_types=1);

namespace MDP\DB\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313005909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE FailedLoginAttemp CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Profile ADD customer_id INT DEFAULT NULL, CHANGE imagePath imagePath VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Profile ADD CONSTRAINT FK_4EEA93939395C3F3 FOREIGN KEY (customer_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4EEA93939395C3F3 ON Profile (customer_id)');
        $this->addSql('ALTER TABLE users CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE FailedLoginAttemp CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE Profile DROP FOREIGN KEY FK_4EEA93939395C3F3');
        $this->addSql('DROP INDEX UNIQ_4EEA93939395C3F3 ON Profile');
        $this->addSql('ALTER TABLE Profile DROP customer_id, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE imagePath imagePath VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE users CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
