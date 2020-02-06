<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200206112338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE groupe CHANGE user_p_id user_p_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE groupe_id groupe_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE state state INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groupe CHANGE user_p_id user_p_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE groupe_id groupe_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE state state INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP email');
    }
}
