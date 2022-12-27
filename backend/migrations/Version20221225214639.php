<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221225214639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personal_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_user_comments_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE theme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_pages_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(40) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, user_id_id INT DEFAULT NULL, post_id INT DEFAULT NULL, caption VARCHAR(45) NOT NULL, status INT DEFAULT 1 NOT NULL, added_ago VARCHAR(255) NOT NULL, content VARCHAR(250) NOT NULL, likes INT DEFAULT 0 NOT NULL, shared INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C9D86650F ON comment (user_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('COMMENT ON COLUMN comment.added_ago IS \'(DC2Type:dateinterval)\'');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE page (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, editable BOOLEAN NOT NULL, description VARCHAR(255) DEFAULT NULL, url VARCHAR(30) NOT NULL, published BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_140AB620A76ED395 ON page (user_id)');
        $this->addSql('COMMENT ON COLUMN page.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE personal_info (id INT NOT NULL, work_as VARCHAR(255) NOT NULL, university VARCHAR(255) NOT NULL, socials JSON DEFAULT NULL, skills JSON NOT NULL, projects JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN personal_info.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, user_id INT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(180) NOT NULL, description VARCHAR(255) NOT NULL, content TEXT NOT NULL, likes INT DEFAULT 0 NOT NULL, status INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
        $this->addSql('COMMENT ON COLUMN post.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_5ACE3AF04B89032C ON post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_5ACE3AF0BAD26311 ON post_tag (tag_id)');
        $this->addSql('CREATE TABLE post_user_comments_history (id INT NOT NULL, user_id_id INT DEFAULT NULL, post_id INT DEFAULT NULL, comment_id INT DEFAULT NULL, action INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7D61D589D86650F ON post_user_comments_history (user_id_id)');
        $this->addSql('CREATE INDEX IDX_F7D61D584B89032C ON post_user_comments_history (post_id)');
        $this->addSql('CREATE INDEX IDX_F7D61D58F8697D13 ON post_user_comments_history (comment_id)');
        $this->addSql('COMMENT ON COLUMN post_user_comments_history.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(30) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tag.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE theme (id INT NOT NULL, page_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, background_url VARCHAR(255) NOT NULL, logo_url VARCHAR(255) DEFAULT NULL, thumbnail_url VARCHAR(255) DEFAULT NULL, editable_parts JSON DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, published BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9775E708C4663E4 ON theme (page_id)');
        $this->addSql('COMMENT ON COLUMN theme.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_pages_history (id INT NOT NULL, user_id INT DEFAULT NULL, page_id INT DEFAULT NULL, action INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_59264AF1A76ED395 ON user_pages_history (user_id)');
        $this->addSql('CREATE INDEX IDX_59264AF1C4663E4 ON user_pages_history (page_id)');
        $this->addSql('COMMENT ON COLUMN user_pages_history.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_user_comments_history ADD CONSTRAINT FK_F7D61D589D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_user_comments_history ADD CONSTRAINT FK_F7D61D584B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_user_comments_history ADD CONSTRAINT FK_F7D61D58F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pages_history ADD CONSTRAINT FK_59264AF1A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pages_history ADD CONSTRAINT FK_59264AF1C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personal_info_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_user_comments_history_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE theme_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_pages_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE page DROP CONSTRAINT FK_140AB620A76ED395');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE post_tag DROP CONSTRAINT FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP CONSTRAINT FK_5ACE3AF0BAD26311');
        $this->addSql('ALTER TABLE post_user_comments_history DROP CONSTRAINT FK_F7D61D589D86650F');
        $this->addSql('ALTER TABLE post_user_comments_history DROP CONSTRAINT FK_F7D61D584B89032C');
        $this->addSql('ALTER TABLE post_user_comments_history DROP CONSTRAINT FK_F7D61D58F8697D13');
        $this->addSql('ALTER TABLE theme DROP CONSTRAINT FK_9775E708C4663E4');
        $this->addSql('ALTER TABLE user_pages_history DROP CONSTRAINT FK_59264AF1A76ED395');
        $this->addSql('ALTER TABLE user_pages_history DROP CONSTRAINT FK_59264AF1C4663E4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE personal_info');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('DROP TABLE post_user_comments_history');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user_pages_history');
    }
}
