<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726144713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_de_devis ADD mariee_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_de_devis ADD CONSTRAINT FK_1E89D3BCC742AEC6 FOREIGN KEY (mariee_id) REFERENCES mariee (id)');
        $this->addSql('CREATE INDEX IDX_1E89D3BCC742AEC6 ON demande_de_devis (mariee_id)');
        $this->addSql('ALTER TABLE images ADD mariee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC742AEC6 FOREIGN KEY (mariee_id) REFERENCES mariee (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AC742AEC6 ON images (mariee_id)');
        $this->addSql('ALTER TABLE type_de_maquillage ADD mariee_id INT NOT NULL');
        $this->addSql('ALTER TABLE type_de_maquillage ADD CONSTRAINT FK_77742E5C742AEC6 FOREIGN KEY (mariee_id) REFERENCES mariee (id)');
        $this->addSql('CREATE INDEX IDX_77742E5C742AEC6 ON type_de_maquillage (mariee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_de_devis DROP FOREIGN KEY FK_1E89D3BCC742AEC6');
        $this->addSql('DROP INDEX IDX_1E89D3BCC742AEC6 ON demande_de_devis');
        $this->addSql('ALTER TABLE demande_de_devis DROP mariee_id');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC742AEC6');
        $this->addSql('DROP INDEX IDX_E01FBE6AC742AEC6 ON images');
        $this->addSql('ALTER TABLE images DROP mariee_id');
        $this->addSql('ALTER TABLE type_de_maquillage DROP FOREIGN KEY FK_77742E5C742AEC6');
        $this->addSql('DROP INDEX IDX_77742E5C742AEC6 ON type_de_maquillage');
        $this->addSql('ALTER TABLE type_de_maquillage DROP mariee_id');
    }
}
