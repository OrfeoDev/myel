<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726145257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mariee ADD demande_statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mariee ADD CONSTRAINT FK_2987157830CC2D1 FOREIGN KEY (demande_statut_id) REFERENCES demande_statut (id)');
        $this->addSql('CREATE INDEX IDX_2987157830CC2D1 ON mariee (demande_statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mariee DROP FOREIGN KEY FK_2987157830CC2D1');
        $this->addSql('DROP INDEX IDX_2987157830CC2D1 ON mariee');
        $this->addSql('ALTER TABLE mariee DROP demande_statut_id');
    }
}
