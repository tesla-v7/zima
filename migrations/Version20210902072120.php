<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902072120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, range_date_sales_id_id INT NOT NULL, sale_date DATE NOT NULL, sale_sum INT NOT NULL, sale_count INT NOT NULL, INDEX IDX_F5299398DE18E50B (product_id_id), INDEX IDX_F52993985384F51C (range_date_sales_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE range_date_sale (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, date_start DATETIME NOT NULL, date_stop DATETIME NOT NULL, INDEX IDX_8A04EF0CDE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985384F51C FOREIGN KEY (range_date_sales_id_id) REFERENCES range_date_sale (id)');
        $this->addSql('ALTER TABLE range_date_sale ADD CONSTRAINT FK_8A04EF0CDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DE18E50B');
        $this->addSql('ALTER TABLE range_date_sale DROP FOREIGN KEY FK_8A04EF0CDE18E50B');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993985384F51C');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE range_date_sale');
    }
}
