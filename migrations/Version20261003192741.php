<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261003192741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create local authentication and deterministic lab fixture storage';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE lab_object (id VARCHAR(100) NOT NULL, kind VARCHAR(30) NOT NULL, data JSON NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE pam_session (tokenHash VARCHAR(64) NOT NULL, provider VARCHAR(20) NOT NULL, createdAt INT NOT NULL, expiresAt INT NOT NULL, lastActivity INT NOT NULL, connectionNumber INT DEFAULT NULL, username VARCHAR(80) NOT NULL, PRIMARY KEY (tokenHash))');
        $this->addSql('CREATE INDEX IDX_C7820162F85E0677 ON pam_session (username)');
        $this->addSql('CREATE TABLE pam_user (username VARCHAR(80) NOT NULL, provider VARCHAR(20) NOT NULL, passwordHash VARCHAR(255) NOT NULL, state VARCHAR(20) NOT NULL, persona VARCHAR(80) NOT NULL, PRIMARY KEY (username))');
        $this->addSql('ALTER TABLE pam_session ADD CONSTRAINT FK_C7820162F85E0677 FOREIGN KEY (username) REFERENCES pam_user (username) ON DELETE CASCADE NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE pam_session DROP CONSTRAINT FK_C7820162F85E0677');
        $this->addSql('DROP TABLE lab_object');
        $this->addSql('DROP TABLE pam_session');
        $this->addSql('DROP TABLE pam_user');
    }
}
