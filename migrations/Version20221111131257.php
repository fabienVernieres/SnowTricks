<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111131257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_2F57B37A3DA5256D ON figure (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A3DA5256D');
        $this->addSql('DROP INDEX IDX_2F57B37A3DA5256D ON figure');
        $this->addSql('ALTER TABLE figure ADD image VARCHAR(255) NOT NULL, DROP image_id');
    }
}
