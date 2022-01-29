<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128201156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cellar_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cepage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cepage_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE millesime_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cellar (id INT NOT NULL, owner_id INT NOT NULL, ordinate_length INT NOT NULL, abscissa_length INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9CA014637E3C61F9 ON cellar (owner_id)');
        $this->addSql('COMMENT ON COLUMN cellar.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cellar.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cepage (id INT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B3E4D5698260155 ON cepage (region_id)');
        $this->addSql('CREATE TABLE cepage_property (id INT NOT NULL, cepage_id INT NOT NULL, wine_id INT NOT NULL, percent DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_88F790458AC6BB8A ON cepage_property (cepage_id)');
        $this->addSql('CREATE INDEX IDX_88F7904528A2BD76 ON cepage_property (wine_id)');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE millesime (id INT NOT NULL, wine_id INT NOT NULL, year INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3574A7A028A2BD76 ON millesime (wine_id)');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F62F176F92F3E70 ON region (country_id)');
        $this->addSql('CREATE TABLE wine (id INT NOT NULL, region_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_560C646898260155 ON wine (region_id)');
        $this->addSql('CREATE INDEX IDX_560C646812469DE2 ON wine (category_id)');
        $this->addSql('COMMENT ON COLUMN wine.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN wine.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cellar ADD CONSTRAINT FK_9CA014637E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cepage ADD CONSTRAINT FK_5B3E4D5698260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cepage_property ADD CONSTRAINT FK_88F790458AC6BB8A FOREIGN KEY (cepage_id) REFERENCES cepage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cepage_property ADD CONSTRAINT FK_88F7904528A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE millesime ADD CONSTRAINT FK_3574A7A028A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C646898260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C646812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE wine DROP CONSTRAINT FK_560C646812469DE2');
        $this->addSql('ALTER TABLE cepage_property DROP CONSTRAINT FK_88F790458AC6BB8A');
        $this->addSql('ALTER TABLE region DROP CONSTRAINT FK_F62F176F92F3E70');
        $this->addSql('ALTER TABLE cepage DROP CONSTRAINT FK_5B3E4D5698260155');
        $this->addSql('ALTER TABLE wine DROP CONSTRAINT FK_560C646898260155');
        $this->addSql('ALTER TABLE cepage_property DROP CONSTRAINT FK_88F7904528A2BD76');
        $this->addSql('ALTER TABLE millesime DROP CONSTRAINT FK_3574A7A028A2BD76');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cellar_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cepage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cepage_property_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE millesime_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE wine_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE cellar');
        $this->addSql('DROP TABLE cepage');
        $this->addSql('DROP TABLE cepage_property');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE millesime');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE wine');
    }
}
