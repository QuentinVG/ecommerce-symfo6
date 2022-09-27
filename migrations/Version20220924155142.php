<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220924155142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEF215334A');
        $this->addSql('ALTER TABLE orders_articles DROP FOREIGN KEY FK_78FBECAE7294869C');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, category_order INT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_3AF34668727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons (id INT AUTO_INCREMENT NOT NULL, coupons_types_id INT NOT NULL, code VARCHAR(10) NOT NULL, description LONGTEXT NOT NULL, discount INT NOT NULL, max_usage INT NOT NULL, validity DATETIME NOT NULL, is_valid TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_F564111877153098 (code), INDEX IDX_F56411183DDD47B7 (coupons_types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, products_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A6C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_details (orders_id INT NOT NULL, products_id INT NOT NULL, quantity INT NOT NULL, price INT NOT NULL, INDEX IDX_835379F1CFFE9AD6 (orders_id), INDEX IDX_835379F16C8A81A9 (products_id), PRIMARY KEY(orders_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, stock INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5AA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(150) NOT NULL, is_verified TINYINT(1) NOT NULL, reset_token VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F56411183DDD47B7 FOREIGN KEY (coupons_types_id) REFERENCES coupons_types (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F16C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('DROP TABLE blog_article');
        $this->addSql('DROP TABLE orders_articles');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_E52FFDEEF215334A ON orders');
        $this->addSql('ALTER TABLE orders ADD users_id INT NOT NULL, ADD reference VARCHAR(20) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE fk_article coupons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE6D72B15C FOREIGN KEY (coupons_id) REFERENCES coupons (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E52FFDEEAEA34913 ON orders (reference)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE6D72B15C ON orders (coupons_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE67B3B43D ON orders (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AA21214B7');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE6D72B15C');
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F56411183DDD47B7');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A6C8A81A9');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F16C8A81A9');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE67B3B43D');
        $this->addSql('CREATE TABLE blog_article (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, author VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders_articles (article_id INT NOT NULL, command_id INT NOT NULL, INDEX IDX_78FBECAE33E1689A (command_id), INDEX IDX_78FBECAE7294869C (article_id), PRIMARY KEY(article_id, command_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE orders_articles ADD CONSTRAINT FK_78FBECAE33E1689A FOREIGN KEY (command_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_articles ADD CONSTRAINT FK_78FBECAE7294869C FOREIGN KEY (article_id) REFERENCES blog_article (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE coupons_types');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE orders_details');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP INDEX UNIQ_E52FFDEEAEA34913 ON orders');
        $this->addSql('DROP INDEX IDX_E52FFDEE6D72B15C ON orders');
        $this->addSql('DROP INDEX IDX_E52FFDEE67B3B43D ON orders');
        $this->addSql('ALTER TABLE orders DROP users_id, DROP reference, DROP created_at, CHANGE coupons_id fk_article INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEF215334A FOREIGN KEY (fk_article) REFERENCES blog_article (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEF215334A ON orders (fk_article)');
    }
}
