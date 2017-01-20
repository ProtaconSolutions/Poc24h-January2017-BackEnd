<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120122551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            strtolower($this->connection->getDatabasePlatform()->getName()) !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE offer (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', workshop_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(12, 2) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), INDEX workshop_id (workshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E1FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            strtolower($this->connection->getDatabasePlatform()->getName()) !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('DROP TABLE offer');
    }
}
