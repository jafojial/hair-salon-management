<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250919143252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE availability_exception (id SERIAL NOT NULL, salon_id INT NOT NULL, stylist_id INT DEFAULT NULL, date DATE NOT NULL, closed BOOLEAN NOT NULL, reason VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E25FAB4C91BDE4 ON availability_exception (salon_id)');
        $this->addSql('CREATE INDEX IDX_5E25FAB4066877A ON availability_exception (stylist_id)');
        $this->addSql('CREATE TABLE booking (id SERIAL NOT NULL, salon_id INT NOT NULL, stylist_id INT NOT NULL, client_id INT NOT NULL, service_id INT NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E00CEDDE4C91BDE4 ON booking (salon_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE4066877A ON booking (stylist_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE19EB6921 ON booking (client_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEED5CA9E6 ON booking (service_id)');
        $this->addSql('COMMENT ON COLUMN booking.start_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.end_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN booking.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE media (id SERIAL NOT NULL, stylist_id INT NOT NULL, path VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, mime VARCHAR(255) NOT NULL, size_bytes INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4066877A ON media (stylist_id)');
        $this->addSql('COMMENT ON COLUMN media.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE review (id SERIAL NOT NULL, booking_id INT NOT NULL, client_id INT NOT NULL, stylist_id INT NOT NULL, rating INT NOT NULL, comment TEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C63301C60 ON review (booking_id)');
        $this->addSql('CREATE INDEX IDX_794381C619EB6921 ON review (client_id)');
        $this->addSql('CREATE INDEX IDX_794381C64066877A ON review (stylist_id)');
        $this->addSql('COMMENT ON COLUMN review.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN review.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE salon (id SERIAL NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, quarter VARCHAR(255) NOT NULL, lat VARCHAR(255) DEFAULT NULL, long VARCHAR(255) DEFAULT NULL, open_hours JSON DEFAULT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F268F4177E3C61F9 ON salon (owner_id)');
        $this->addSql('CREATE TABLE service (id SERIAL NOT NULL, salon_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, duration INT NOT NULL, price NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD24C91BDE4 ON service (salon_id)');
        $this->addSql('CREATE TABLE stylist (id SERIAL NOT NULL, usr_id INT NOT NULL, salon_id INT NOT NULL, languages JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4111FFA5C69D3FB ON stylist (usr_id)');
        $this->addSql('CREATE INDEX IDX_4111FFA54C91BDE4 ON stylist (salon_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, country_code VARCHAR(50) NOT NULL, phone VARCHAR(20) DEFAULT NULL, email_verified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".email_verified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE availability_exception ADD CONSTRAINT FK_5E25FAB4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE availability_exception ADD CONSTRAINT FK_5E25FAB4066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE4066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C63301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F4177E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD24C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stylist ADD CONSTRAINT FK_4111FFA5C69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stylist ADD CONSTRAINT FK_4111FFA54C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE availability_exception DROP CONSTRAINT FK_5E25FAB4C91BDE4');
        $this->addSql('ALTER TABLE availability_exception DROP CONSTRAINT FK_5E25FAB4066877A');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE4C91BDE4');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE4066877A');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE19EB6921');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDEED5CA9E6');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C4066877A');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C63301C60');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C619EB6921');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C64066877A');
        $this->addSql('ALTER TABLE salon DROP CONSTRAINT FK_F268F4177E3C61F9');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD24C91BDE4');
        $this->addSql('ALTER TABLE stylist DROP CONSTRAINT FK_4111FFA5C69D3FB');
        $this->addSql('ALTER TABLE stylist DROP CONSTRAINT FK_4111FFA54C91BDE4');
        $this->addSql('DROP TABLE availability_exception');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE stylist');
        $this->addSql('DROP TABLE "user"');
    }
}
