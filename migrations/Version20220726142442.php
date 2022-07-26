<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726142442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires ADD mariee_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4C742AEC6 FOREIGN KEY (mariee_id) REFERENCES mariee (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4C742AEC6 ON commentaires (mariee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4C742AEC6');
        $this->addSql('DROP INDEX IDX_D9BEC0C4C742AEC6 ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP mariee_id');
    }
}
