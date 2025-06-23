<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250623085411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ingredients_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient ADD ingredients_category_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870EC54853C FOREIGN KEY (ingredients_category_id) REFERENCES ingredients_category (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6BAF7870EC54853C ON ingredient (ingredients_category_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870EC54853C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ingredients_category
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6BAF7870EC54853C ON ingredient
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient DROP ingredients_category_id
        SQL);
    }
}
