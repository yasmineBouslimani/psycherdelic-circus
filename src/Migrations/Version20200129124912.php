<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129124912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, comment_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, INDEX IDX_81398E09F8697D13 (comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, INDEX IDX_92ED7784B7970CF8 (artist_id), INDEX IDX_92ED7784A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, program_id INT DEFAULT NULL, comment VARCHAR(255) NOT NULL, rate INT DEFAULT NULL, INDEX IDX_9474526C9395C3F3 (customer_id), INDEX IDX_9474526C3EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrator (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_price (id INT AUTO_INCREMENT NOT NULL, programs_id INT DEFAULT NULL, price INT NOT NULL, INDEX IDX_54A1512F79AEC3C (programs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784A21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE program_price ADD CONSTRAINT FK_54A1512F79AEC3C FOREIGN KEY (programs_id) REFERENCES program (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784A21214B7');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9395C3F3');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3EB8070A');
        $this->addSql('ALTER TABLE program_price DROP FOREIGN KEY FK_54A1512F79AEC3C');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09F8697D13');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784B7970CF8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE program_price');
        $this->addSql('DROP TABLE artist');
    }
}
