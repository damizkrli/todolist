<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241028144024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE use0 (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25B8E08577');
        $this->addSql('DROP INDEX IDX_527EDB25B8E08577 ON task');
        $this->addSql('ALTER TABLE task CHANGE task_id_id task_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258DB60186 FOREIGN KEY (task_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB258DB60186 ON task (task_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE use0');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258DB60186');
        $this->addSql('DROP INDEX IDX_527EDB258DB60186 ON task');
        $this->addSql('ALTER TABLE task CHANGE task_id task_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B8E08577 FOREIGN KEY (task_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_527EDB25B8E08577 ON task (task_id_id)');
    }
}
