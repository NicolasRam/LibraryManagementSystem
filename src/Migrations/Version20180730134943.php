<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730134943 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_8D93D6497AB83B07');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, member_type_id, first_name, last_name, email, password, roles, user_type FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_type_id INTEGER DEFAULT NULL, first_name VARCHAR(50) NOT NULL COLLATE BINARY, last_name VARCHAR(50) NOT NULL COLLATE BINARY, email VARCHAR(254) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:simple_array)
        , user_type VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8D93D6497AB83B07 FOREIGN KEY (member_type_id) REFERENCES member_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, member_type_id, first_name, last_name, email, password, roles, user_type) SELECT id, member_type_id, first_name, last_name, email, password, roles, user_type FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D6497AB83B07 ON user (member_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, author_id, isbn, title, resume, page_number, cover FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, isbn VARCHAR(255) NOT NULL COLLATE BINARY, title VARCHAR(255) NOT NULL COLLATE BINARY, resume VARCHAR(500) DEFAULT NULL COLLATE BINARY, page_number INTEGER DEFAULT NULL, cover CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:object)
        , CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, author_id, isbn, title, resume, page_number, cover) SELECT id, author_id, isbn, title, resume, page_number, cover FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('DROP INDEX IDX_9478D345F675F31B');
        $this->addSql('DROP INDEX IDX_9478D34516A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_author AS SELECT book_id, author_id FROM book_author');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id), CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book_author (book_id, author_id) SELECT book_id, author_id FROM __temp__book_author');
        $this->addSql('DROP TABLE __temp__book_author');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('DROP INDEX IDX_E00CEDDE7597D3FE');
        $this->addSql('DROP INDEX IDX_E00CEDDE42BC2206');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, pbook_id, member_id, start_date, end_date, return_date FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, p_book_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, return_date DATE DEFAULT NULL, CONSTRAINT FK_E00CEDDE11625AEE FOREIGN KEY (p_book_id) REFERENCES pbook (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E00CEDDE7597D3FE FOREIGN KEY (member_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO booking (id, p_book_id, member_id, start_date, end_date, return_date) SELECT id, pbook_id, member_id, start_date, end_date, return_date FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE7597D3FE ON booking (member_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE11625AEE ON booking (p_book_id)');
        $this->addSql('DROP INDEX UNIQ_7D51730D93CB796C');
        $this->addSql('DROP INDEX IDX_7D51730D16A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ebook AS SELECT id, book_id, file_id FROM ebook');
        $this->addSql('DROP TABLE ebook');
        $this->addSql('CREATE TABLE ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER DEFAULT NULL, file_id INTEGER DEFAULT NULL, CONSTRAINT FK_7D51730D16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7D51730D93CB796C FOREIGN KEY (file_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ebook (id, book_id, file_id) SELECT id, book_id, file_id FROM __temp__ebook');
        $this->addSql('DROP TABLE __temp__ebook');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D51730D93CB796C ON ebook (file_id)');
        $this->addSql('CREATE INDEX IDX_7D51730D16A2B381 ON ebook (book_id)');
        $this->addSql('DROP INDEX IDX_1F70E6FE76E71D49');
        $this->addSql('DROP INDEX IDX_1F70E6FE7597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ebook AS SELECT id, member_id, ebook_id, date, price FROM member_ebook');
        $this->addSql('DROP TABLE member_ebook');
        $this->addSql('CREATE TABLE member_ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, e_book_id INTEGER NOT NULL, date DATETIME NOT NULL, price INTEGER NOT NULL, CONSTRAINT FK_1F70E6FE7597D3FE FOREIGN KEY (member_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F70E6FEF7355DD0 FOREIGN KEY (e_book_id) REFERENCES ebook (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member_ebook (id, member_id, e_book_id, date, price) SELECT id, member_id, ebook_id, date, price FROM __temp__member_ebook');
        $this->addSql('DROP TABLE __temp__member_ebook');
        $this->addSql('CREATE INDEX IDX_1F70E6FE7597D3FE ON member_ebook (member_id)');
        $this->addSql('CREATE INDEX IDX_1F70E6FEF7355DD0 ON member_ebook (e_book_id)');
        $this->addSql('DROP INDEX IDX_D675FA5B7597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_subscription AS SELECT id, member_id, start, "end" FROM member_subscription');
        $this->addSql('DROP TABLE member_subscription');
        $this->addSql('CREATE TABLE member_subscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, start DATETIME NOT NULL, "end" DATETIME NOT NULL, CONSTRAINT FK_D675FA5B7597D3FE FOREIGN KEY (member_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member_subscription (id, member_id, start, "end") SELECT id, member_id, start, "end" FROM __temp__member_subscription');
        $this->addSql('DROP TABLE __temp__member_subscription');
        $this->addSql('CREATE INDEX IDX_D675FA5B7597D3FE ON member_subscription (member_id)');
        $this->addSql('DROP INDEX IDX_D5516BFFFE2541D7');
        $this->addSql('DROP INDEX UNIQ_D5516BFF16A2B381');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pbook AS SELECT id, book_id, library_id, status FROM pbook');
        $this->addSql('DROP TABLE pbook');
        $this->addSql('CREATE TABLE pbook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER NOT NULL, library_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D5516BFF16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D5516BFFFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO pbook (id, book_id, library_id, status) SELECT id, book_id, library_id, status FROM __temp__pbook');
        $this->addSql('DROP TABLE __temp__pbook');
        $this->addSql('CREATE INDEX IDX_D5516BFFFE2541D7 ON pbook (library_id)');
        $this->addSql('CREATE INDEX IDX_D5516BFF16A2B381 ON pbook (book_id)');
        $this->addSql('DROP INDEX IDX_BCE3F79864D218E');
        $this->addSql('DROP INDEX IDX_BCE3F79812469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sub_category AS SELECT id, category_id, location_id, name FROM sub_category');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('CREATE TABLE sub_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, location_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BCE3F79864D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sub_category (id, category_id, location_id, name) SELECT id, category_id, location_id, name FROM __temp__sub_category');
        $this->addSql('DROP TABLE __temp__sub_category');
        $this->addSql('CREATE INDEX IDX_BCE3F79864D218E ON sub_category (location_id)');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, author_id, isbn, title, resume, page_number, cover FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, isbn VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, resume VARCHAR(500) DEFAULT NULL, page_number INTEGER DEFAULT NULL, cover CLOB DEFAULT NULL --(DC2Type:object)
        )');
        $this->addSql('INSERT INTO book (id, author_id, isbn, title, resume, page_number, cover) SELECT id, author_id, isbn, title, resume, page_number, cover FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('DROP INDEX IDX_9478D34516A2B381');
        $this->addSql('DROP INDEX IDX_9478D345F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_author AS SELECT book_id, author_id FROM book_author');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('CREATE TABLE book_author (book_id INTEGER NOT NULL, author_id INTEGER NOT NULL, PRIMARY KEY(book_id, author_id))');
        $this->addSql('INSERT INTO book_author (book_id, author_id) SELECT book_id, author_id FROM __temp__book_author');
        $this->addSql('DROP TABLE __temp__book_author');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('DROP INDEX IDX_E00CEDDE11625AEE');
        $this->addSql('DROP INDEX IDX_E00CEDDE7597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__booking AS SELECT id, p_book_id, member_id, start_date, end_date, return_date FROM booking');
        $this->addSql('DROP TABLE booking');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, return_date DATE DEFAULT NULL, pbook_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO booking (id, pbook_id, member_id, start_date, end_date, return_date) SELECT id, p_book_id, member_id, start_date, end_date, return_date FROM __temp__booking');
        $this->addSql('DROP TABLE __temp__booking');
        $this->addSql('CREATE INDEX IDX_E00CEDDE7597D3FE ON booking (member_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE42BC2206 ON booking (pbook_id)');
        $this->addSql('DROP INDEX IDX_7D51730D16A2B381');
        $this->addSql('DROP INDEX UNIQ_7D51730D93CB796C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ebook AS SELECT id, book_id, file_id FROM ebook');
        $this->addSql('DROP TABLE ebook');
        $this->addSql('CREATE TABLE ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER DEFAULT NULL, file_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO ebook (id, book_id, file_id) SELECT id, book_id, file_id FROM __temp__ebook');
        $this->addSql('DROP TABLE __temp__ebook');
        $this->addSql('CREATE INDEX IDX_7D51730D16A2B381 ON ebook (book_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D51730D93CB796C ON ebook (file_id)');
        $this->addSql('DROP INDEX IDX_1F70E6FE7597D3FE');
        $this->addSql('DROP INDEX IDX_1F70E6FEF7355DD0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ebook AS SELECT id, member_id, e_book_id, date, price FROM member_ebook');
        $this->addSql('DROP TABLE member_ebook');
        $this->addSql('CREATE TABLE member_ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, date DATETIME NOT NULL, price INTEGER NOT NULL, ebook_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO member_ebook (id, member_id, ebook_id, date, price) SELECT id, member_id, e_book_id, date, price FROM __temp__member_ebook');
        $this->addSql('DROP TABLE __temp__member_ebook');
        $this->addSql('CREATE INDEX IDX_1F70E6FE7597D3FE ON member_ebook (member_id)');
        $this->addSql('CREATE INDEX IDX_1F70E6FE76E71D49 ON member_ebook (ebook_id)');
        $this->addSql('DROP INDEX IDX_D675FA5B7597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_subscription AS SELECT id, member_id, start, "end" FROM member_subscription');
        $this->addSql('DROP TABLE member_subscription');
        $this->addSql('CREATE TABLE member_subscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, start DATETIME NOT NULL, "end" DATETIME NOT NULL)');
        $this->addSql('INSERT INTO member_subscription (id, member_id, start, "end") SELECT id, member_id, start, "end" FROM __temp__member_subscription');
        $this->addSql('DROP TABLE __temp__member_subscription');
        $this->addSql('CREATE INDEX IDX_D675FA5B7597D3FE ON member_subscription (member_id)');
        $this->addSql('DROP INDEX IDX_D5516BFF16A2B381');
        $this->addSql('DROP INDEX IDX_D5516BFFFE2541D7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pbook AS SELECT id, book_id, library_id, status FROM pbook');
        $this->addSql('DROP TABLE pbook');
        $this->addSql('CREATE TABLE pbook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER NOT NULL, library_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO pbook (id, book_id, library_id, status) SELECT id, book_id, library_id, status FROM __temp__pbook');
        $this->addSql('DROP TABLE __temp__pbook');
        $this->addSql('CREATE INDEX IDX_D5516BFFFE2541D7 ON pbook (library_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5516BFF16A2B381 ON pbook (book_id)');
        $this->addSql('DROP INDEX IDX_BCE3F79812469DE2');
        $this->addSql('DROP INDEX IDX_BCE3F79864D218E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sub_category AS SELECT id, category_id, location_id, name FROM sub_category');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('CREATE TABLE sub_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, location_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO sub_category (id, category_id, location_id, name) SELECT id, category_id, location_id, name FROM __temp__sub_category');
        $this->addSql('DROP TABLE __temp__sub_category');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
        $this->addSql('CREATE INDEX IDX_BCE3F79864D218E ON sub_category (location_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX IDX_8D93D6497AB83B07');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, member_type_id, first_name, last_name, email, password, roles, user_type FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_type_id INTEGER DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:simple_array)
        , user_type VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, member_type_id, first_name, last_name, email, password, roles, user_type) SELECT id, member_type_id, first_name, last_name, email, password, roles, user_type FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D6497AB83B07 ON user (member_type_id)');
    }
}
