<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250613133823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE article ADD category_id INT DEFAULT NULL, ADD tags_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article ADD CONSTRAINT FK_23A0E668D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tag (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23A0E668D7B4FB4 ON article (tags_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD article_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526C7294869C ON comment (article_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article DROP FOREIGN KEY FK_23A0E668D7B4FB4
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23A0E6612469DE2 ON article
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23A0E668D7B4FB4 ON article
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article DROP category_id, DROP tags_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526C7294869C ON comment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP article_id
        SQL);
    }
}
