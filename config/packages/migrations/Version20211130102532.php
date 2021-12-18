<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211130102532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD id_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F99DED506 ON message (id_client_id)');
        $this->addSql('ALTER TABLE reponse ADD id_message_id INT DEFAULT NULL, ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7F6F093FE FOREIGN KEY (id_message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7F6F093FE ON reponse (id_message_id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC779F37AE5 ON reponse (id_user_id)');
        $this->addSql('ALTER TABLE section ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2D737AEF79F37AE5 ON section (id_user_id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F99DED506');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_B6BD307F99DED506 ON message');
        $this->addSql('ALTER TABLE message DROP id_client_id');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7F6F093FE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC779F37AE5');
        $this->addSql('DROP INDEX IDX_5FB6DEC7F6F093FE ON reponse');
        $this->addSql('DROP INDEX IDX_5FB6DEC779F37AE5 ON reponse');
        $this->addSql('ALTER TABLE reponse DROP id_message_id, DROP id_user_id');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF79F37AE5');
        $this->addSql('DROP INDEX IDX_2D737AEF79F37AE5 ON section');
        $this->addSql('ALTER TABLE section DROP id_user_id');
        $this->addSql('ALTER TABLE user DROP username');
    }
}
