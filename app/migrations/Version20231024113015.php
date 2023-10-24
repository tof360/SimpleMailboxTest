<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024113015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, is_from_id INT NOT NULL, subject VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, draft TINYINT(1) NOT NULL, archived TINYINT(1) NOT NULL, body LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_5126AC486EF25FC3 (is_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_user (mail_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_20E84520C8776F01 (mail_id), INDEX IDX_20E84520A76ED395 (user_id), PRIMARY KEY(mail_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC486EF25FC3 FOREIGN KEY (is_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mail_user ADD CONSTRAINT FK_20E84520C8776F01 FOREIGN KEY (mail_id) REFERENCES mail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_user ADD CONSTRAINT FK_20E84520A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC486EF25FC3');
        $this->addSql('ALTER TABLE mail_user DROP FOREIGN KEY FK_20E84520C8776F01');
        $this->addSql('ALTER TABLE mail_user DROP FOREIGN KEY FK_20E84520A76ED395');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE mail_user');
    }
}
