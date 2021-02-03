<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203121746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387299E6F5DF');
        $this->addSql('DROP INDEX IDX_B8EE387299E6F5DF ON club');
        $this->addSql('ALTER TABLE club DROP player_id');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C96699E6F5DF');
        $this->addSql('DROP INDEX IDX_5373C96699E6F5DF ON country');
        $this->addSql('ALTER TABLE country DROP player_id');
        $this->addSql('ALTER TABLE player ADD club_id INT NOT NULL, ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_98197A6561190A32 ON player (club_id)');
        $this->addSql('CREATE INDEX IDX_98197A65F92F3E70 ON player (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B8EE387299E6F5DF ON club (player_id)');
        $this->addSql('ALTER TABLE country ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96699E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5373C96699E6F5DF ON country (player_id)');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6561190A32');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65F92F3E70');
        $this->addSql('DROP INDEX IDX_98197A6561190A32 ON player');
        $this->addSql('DROP INDEX IDX_98197A65F92F3E70 ON player');
        $this->addSql('ALTER TABLE player DROP club_id, DROP country_id');
    }
}
