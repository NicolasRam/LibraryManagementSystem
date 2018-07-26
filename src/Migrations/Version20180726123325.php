<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180726123325 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, biography LONGTEXT DEFAULT NULL, birthday DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, member_type_id INT DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', user_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6497AB83B07 (member_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_subscription (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_D675FA5B7597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, floor INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pbook (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, library_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D5516BFF16A2B381 (book_id), INDEX IDX_D5516BFFFE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_ebook (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, ebook_id INT NOT NULL, date DATETIME NOT NULL, price INT NOT NULL, INDEX IDX_1F70E6FE7597D3FE (member_id), INDEX IDX_1F70E6FE76E71D49 (ebook_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, isbn VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, resume VARCHAR(500) DEFAULT NULL, page_number INT DEFAULT NULL, cover LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', INDEX IDX_CBE5A331F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY(book_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, file_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_BCE3F79812469DE2 (category_id), INDEX IDX_BCE3F79864D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE format (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, opening_date TIME NOT NULL, closing_time TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, pbook_id INT NOT NULL, member_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, return_date DATE DEFAULT NULL, INDEX IDX_E00CEDDE42BC2206 (pbook_id), INDEX IDX_E00CEDDE7597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ebook (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, file_id INT DEFAULT NULL, INDEX IDX_7D51730D16A2B381 (book_id), UNIQUE INDEX UNIQ_7D51730D93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497AB83B07 FOREIGN KEY (member_type_id) REFERENCES member_type (id)');
        $this->addSql('ALTER TABLE member_subscription ADD CONSTRAINT FK_D675FA5B7597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pbook ADD CONSTRAINT FK_D5516BFF16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE pbook ADD CONSTRAINT FK_D5516BFFFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
        $this->addSql('ALTER TABLE member_ebook ADD CONSTRAINT FK_1F70E6FE7597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE member_ebook ADD CONSTRAINT FK_1F70E6FE76E71D49 FOREIGN KEY (ebook_id) REFERENCES ebook (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79864D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE42BC2206 FOREIGN KEY (pbook_id) REFERENCES pbook (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE7597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ebook ADD CONSTRAINT FK_7D51730D16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE ebook ADD CONSTRAINT FK_7D51730D93CB796C FOREIGN KEY (file_id) REFERENCES book (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345F675F31B');
        $this->addSql('ALTER TABLE member_subscription DROP FOREIGN KEY FK_D675FA5B7597D3FE');
        $this->addSql('ALTER TABLE member_ebook DROP FOREIGN KEY FK_1F70E6FE7597D3FE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE7597D3FE');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79864D218E');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE42BC2206');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497AB83B07');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('ALTER TABLE pbook DROP FOREIGN KEY FK_D5516BFF16A2B381');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE ebook DROP FOREIGN KEY FK_7D51730D16A2B381');
        $this->addSql('ALTER TABLE ebook DROP FOREIGN KEY FK_7D51730D93CB796C');
        $this->addSql('ALTER TABLE pbook DROP FOREIGN KEY FK_D5516BFFFE2541D7');
        $this->addSql('ALTER TABLE member_ebook DROP FOREIGN KEY FK_1F70E6FE76E71D49');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE member_subscription');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE pbook');
        $this->addSql('DROP TABLE member_type');
        $this->addSql('DROP TABLE member_ebook');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE ebook');
    }
}
