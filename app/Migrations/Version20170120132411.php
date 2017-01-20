<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120132411 extends AbstractMigration
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

        $this->addSql('ALTER TABLE workshop_has_service DROP FOREIGN KEY FK_BB339947ED5CA9E6');
        $this->addSql('CREATE TABLE workshop_has_service_type (workshop_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', service_type_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_DA7C21FF1FDCE57C (workshop_id), INDEX IDX_DA7C21FFAC8DE0F (service_type_id), PRIMARY KEY(workshop_id, service_type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_type (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workshop_has_service_type ADD CONSTRAINT FK_DA7C21FF1FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_has_service_type ADD CONSTRAINT FK_DA7C21FFAC8DE0F FOREIGN KEY (service_type_id) REFERENCES service_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_type ADD CONSTRAINT FK_429DE3C5B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE service_type ADD CONSTRAINT FK_429DE3C5896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE service_type ADD CONSTRAINT FK_429DE3C5C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE workshop_has_service');
        $this->addSql('ALTER TABLE workshop CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE car_brand CHANGE description description LONGTEXT DEFAULT NULL');
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

        $this->addSql('ALTER TABLE workshop_has_service_type DROP FOREIGN KEY FK_DA7C21FFAC8DE0F');
        $this->addSql('CREATE TABLE service (id CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop_has_service (workshop_id CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', service_id CHAR(36) NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:guid)\', INDEX IDX_BB3399471FDCE57C (workshop_id), INDEX IDX_BB339947ED5CA9E6 (service_id), PRIMARY KEY(workshop_id, service_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE workshop_has_service ADD CONSTRAINT FK_BB339947ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_has_service ADD CONSTRAINT FK_BB3399471FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE workshop_has_service_type');
        $this->addSql('DROP TABLE service_type');
        $this->addSql('ALTER TABLE car_brand CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE offer CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE workshop CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
