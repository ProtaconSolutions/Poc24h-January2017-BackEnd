<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120065301 extends AbstractMigration
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

        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date_dimension (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', date DATE NOT NULL, year INT NOT NULL COMMENT \'A full numeric representation of a year, 4 digits\', month INT NOT NULL COMMENT \'Day of the month without leading zeros; 1 to 12\', day INT NOT NULL COMMENT \'Day of the month without leading zeros; 1 to 31\', quarter INT NOT NULL COMMENT \'Calendar quarter; 1, 2, 3 or 4\', week_number INT NOT NULL COMMENT \'ISO-8601 week number of year, weeks starting on Monday\', day_number_of_week INT NOT NULL COMMENT \'ISO-8601 numeric representation of the day of the week; 1 (for Monday) through 7
         (for Sunday)\', day_number_of_year INT NOT NULL COMMENT \'The day of the year (starting from 0); 0 through 365\', leap_year TINYINT(1) NOT NULL COMMENT \'Whether it\'\'s a leap year\', week_numbering_year INT NOT NULL COMMENT \'ISO-8601 week-numbering year. This has the same value as year, except that if the ISO week
         number (W) belongs to the previous or next year, that year is used instead.\', unix_time BIGINT NOT NULL COMMENT \'Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)\', INDEX date (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_brand (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_login (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', ip VARCHAR(255) NOT NULL, host VARCHAR(255) NOT NULL, agent LONGTEXT NOT NULL, client_type VARCHAR(255) DEFAULT NULL, client_name VARCHAR(255) DEFAULT NULL, client_short_name VARCHAR(255) DEFAULT NULL, client_version VARCHAR(255) DEFAULT NULL, client_engine VARCHAR(255) DEFAULT NULL, os_name VARCHAR(255) DEFAULT NULL, os_short_name VARCHAR(255) DEFAULT NULL, os_version VARCHAR(255) DEFAULT NULL, os_platform VARCHAR(255) DEFAULT NULL, device_name VARCHAR(255) DEFAULT NULL, brand_name VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, login_time DATETIME NOT NULL, INDEX user (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, role VARCHAR(20) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), UNIQUE INDEX uq_role (role), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', updated_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_by_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX created_by_id (created_by_id), INDEX updated_by_id (updated_by_id), INDEX deleted_by_id (deleted_by_id), UNIQUE INDEX uq_username (username), UNIQUE INDEX uq_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_group (user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_28657971A76ED395 (user_id), INDEX IDX_286579711ED93D47 (user_group_id), PRIMARY KEY(user_id, user_group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_log (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', client_ip VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, scheme VARCHAR(5) NOT NULL, http_host VARCHAR(255) NOT NULL, base_path VARCHAR(255) NOT NULL, script VARCHAR(255) NOT NULL, path VARCHAR(255) DEFAULT NULL, query_string LONGTEXT DEFAULT NULL, uri LONGTEXT NOT NULL, controller VARCHAR(255) DEFAULT NULL, action VARCHAR(255) DEFAULT NULL, headers LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', content_type VARCHAR(255) DEFAULT NULL, content_type_short VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, parameters LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', status_code INT NOT NULL, response_content_length INT NOT NULL, is_master_request TINYINT(1) NOT NULL, is_xml_http_request TINYINT(1) NOT NULL, time DATETIME NOT NULL, INDEX user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE car_brand ADD CONSTRAINT FK_C3F97C8FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE car_brand ADD CONSTRAINT FK_C3F97C8F896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE car_brand ADD CONSTRAINT FK_C3F97C8FC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_login ADD CONSTRAINT FK_48CA3048A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_user_group ADD CONSTRAINT FK_28657971A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_group ADD CONSTRAINT FK_286579711ED93D47 FOREIGN KEY (user_group_id) REFERENCES user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_log ADD CONSTRAINT FK_42152989A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
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

        $this->addSql('ALTER TABLE user_user_group DROP FOREIGN KEY FK_286579711ED93D47');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4B03A8386');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4896DBBDE');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4C76F1F52');
        $this->addSql('ALTER TABLE car_brand DROP FOREIGN KEY FK_C3F97C8FB03A8386');
        $this->addSql('ALTER TABLE car_brand DROP FOREIGN KEY FK_C3F97C8F896DBBDE');
        $this->addSql('ALTER TABLE car_brand DROP FOREIGN KEY FK_C3F97C8FC76F1F52');
        $this->addSql('ALTER TABLE user_login DROP FOREIGN KEY FK_48CA3048A76ED395');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DB03A8386');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9D896DBBDE');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DC76F1F52');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649896DBBDE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C76F1F52');
        $this->addSql('ALTER TABLE user_user_group DROP FOREIGN KEY FK_28657971A76ED395');
        $this->addSql('ALTER TABLE request_log DROP FOREIGN KEY FK_42152989A76ED395');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE workshop');
        $this->addSql('DROP TABLE date_dimension');
        $this->addSql('DROP TABLE car_brand');
        $this->addSql('DROP TABLE user_login');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user_group');
        $this->addSql('DROP TABLE request_log');
    }
}
