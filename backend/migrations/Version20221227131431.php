<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227131431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_account_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_account_history (id INT NOT NULL, user_id INT DEFAULT NULL, action INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FC4D088CA76ED395 ON user_account_history (user_id)');
        $this->addSql('COMMENT ON COLUMN user_account_history.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user_account_history ADD CONSTRAINT FK_FC4D088CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_account_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_account_history DROP CONSTRAINT FK_FC4D088CA76ED395');
        $this->addSql('DROP TABLE user_account_history');
    }
}
