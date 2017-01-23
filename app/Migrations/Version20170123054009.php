<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170123054009 extends AbstractMigration
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

        $this->addSql('ALTER TABLE workshop ADD email VARCHAR(255) NOT NULL AFTER name, ADD phone VARCHAR(255) NOT NULL AFTER email, ADD city VARCHAR(255) NOT NULL AFTER phone, ADD postal_code VARCHAR(255) NOT NULL AFTER city, ADD address VARCHAR(255) NOT NULL AFTER postal_code');
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

        $this->addSql('ALTER TABLE workshop DROP email, DROP phone, DROP city, DROP postal_code, DROP address');
    }
}
