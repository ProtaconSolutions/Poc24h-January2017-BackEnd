<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120105815 extends AbstractMigration
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

        $this->addSql('CREATE TABLE workshop_has_car_brand (workshop_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', car_brand_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_56C609C41FDCE57C (workshop_id), INDEX IDX_56C609C4CBC3E50C (car_brand_id), PRIMARY KEY(workshop_id, car_brand_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workshop_has_car_brand ADD CONSTRAINT FK_56C609C41FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_has_car_brand ADD CONSTRAINT FK_56C609C4CBC3E50C FOREIGN KEY (car_brand_id) REFERENCES car_brand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE date_dimension CHANGE day_number_of_week day_number_of_week INT NOT NULL COMMENT \'ISO-8601 numeric representation of the day of the week; 1 (for Monday) through 7 (for Sunday)\', CHANGE week_numbering_year week_numbering_year INT NOT NULL COMMENT \'ISO-8601 week-numbering year. This has the same value as year, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead.\'');
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

        $this->addSql('DROP TABLE workshop_has_car_brand');
        $this->addSql('ALTER TABLE date_dimension CHANGE day_number_of_week day_number_of_week INT NOT NULL COMMENT \'ISO-8601 numeric representation of the day of the week; 1 (for Monday) through 7
                         (for Sunday)\', CHANGE week_numbering_year week_numbering_year INT NOT NULL COMMENT \'ISO-8601 week-numbering year. This has the same value as year, except that if the ISO week
                         number (W) belongs to the previous or next year, that year is used instead.\'');
    }
}
