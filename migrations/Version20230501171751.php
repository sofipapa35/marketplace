<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501171751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relative (id INT AUTO_INCREMENT NOT NULL, cle1_id INT DEFAULT NULL, cle2_id INT DEFAULT NULL, INDEX IDX_6E5B37D9D8413DFC (cle1_id), INDEX IDX_6E5B37D9CAF49212 (cle2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, INDEX IDX_52743D7BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relative ADD CONSTRAINT FK_6E5B37D9D8413DFC FOREIGN KEY (cle1_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE relative ADD CONSTRAINT FK_6E5B37D9CAF49212 FOREIGN KEY (cle2_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD sexe VARCHAR(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relative DROP FOREIGN KEY FK_6E5B37D9D8413DFC');
        $this->addSql('ALTER TABLE relative DROP FOREIGN KEY FK_6E5B37D9CAF49212');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('DROP TABLE relative');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('ALTER TABLE annonce DROP sexe');
    }
}
