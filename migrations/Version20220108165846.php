<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220108165846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE albums (AlbumId INT AUTO_INCREMENT NOT NULL, Title VARCHAR(255) NOT NULL, ArtistId INT DEFAULT NULL, INDEX IFK_AlbumArtistId (ArtistId), PRIMARY KEY(AlbumId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists (ArtistId INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(ArtistId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers (CustomerId INT AUTO_INCREMENT NOT NULL, FirstName VARCHAR(255) NOT NULL, LastName VARCHAR(255) NOT NULL, Company VARCHAR(255) DEFAULT NULL, Address VARCHAR(255) DEFAULT NULL, City VARCHAR(255) DEFAULT NULL, State VARCHAR(255) DEFAULT NULL, Country VARCHAR(255) DEFAULT NULL, PostalCode VARCHAR(255) DEFAULT NULL, Phone VARCHAR(255) DEFAULT NULL, Fax VARCHAR(255) DEFAULT NULL, Email VARCHAR(255) NOT NULL, SupportRepId INT DEFAULT NULL, INDEX IFK_CustomerSupportRepId (SupportRepId), PRIMARY KEY(CustomerId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (EmployeeId INT AUTO_INCREMENT NOT NULL, LastName VARCHAR(255) NOT NULL, FirstName VARCHAR(255) NOT NULL, Title VARCHAR(255) DEFAULT NULL, BirthDate DATETIME DEFAULT NULL, HireDate DATETIME DEFAULT NULL, Address VARCHAR(255) DEFAULT NULL, City VARCHAR(255) DEFAULT NULL, State VARCHAR(255) DEFAULT NULL, Country VARCHAR(255) DEFAULT NULL, PostalCode VARCHAR(255) DEFAULT NULL, Phone VARCHAR(255) DEFAULT NULL, Fax VARCHAR(255) DEFAULT NULL, Email VARCHAR(255) DEFAULT NULL, ReportsTo INT DEFAULT NULL, INDEX IFK_EmployeeReportsTo (ReportsTo), PRIMARY KEY(EmployeeId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (GenreId INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(GenreId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_items (InvoiceLineId INT AUTO_INCREMENT NOT NULL, UnitPrice NUMERIC(10, 2) NOT NULL, Quantity INT NOT NULL, InvoiceId INT DEFAULT NULL, TrackId INT DEFAULT NULL, INDEX IFK_InvoiceLineInvoiceId (InvoiceId), INDEX IFK_InvoiceLineTrackId (TrackId), PRIMARY KEY(InvoiceLineId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoices (InvoiceId INT AUTO_INCREMENT NOT NULL, InvoiceDate DATETIME NOT NULL, BillingAddress VARCHAR(255) DEFAULT NULL, BillingCity VARCHAR(255) DEFAULT NULL, BillingState VARCHAR(255) DEFAULT NULL, BillingCountry VARCHAR(255) DEFAULT NULL, BillingPostalCode VARCHAR(255) DEFAULT NULL, Total NUMERIC(10, 2) NOT NULL, CustomerId INT DEFAULT NULL, INDEX IFK_InvoiceCustomerId (CustomerId), PRIMARY KEY(InvoiceId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_types (MediaTypeId INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(MediaTypeId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlists (PlaylistId INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(PlaylistId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_track (PlaylistId INT NOT NULL, TrackId INT NOT NULL, INDEX IDX_75FFE1E52F7AEDBD (PlaylistId), INDEX IDX_75FFE1E5AE3BCDCC (TrackId), PRIMARY KEY(PlaylistId, TrackId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracks (TrackId INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) NOT NULL, Composer VARCHAR(255) DEFAULT NULL, Milliseconds INT NOT NULL, Bytes INT DEFAULT NULL, UnitPrice NUMERIC(10, 2) NOT NULL, AlbumId INT DEFAULT NULL, MediaTypeId INT DEFAULT NULL, GenreId INT DEFAULT NULL, INDEX IFK_TrackGenreId (GenreId), INDEX IFK_TrackMediaTypeId (MediaTypeId), INDEX IFK_TrackAlbumId (AlbumId), PRIMARY KEY(TrackId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474FBE651800 FOREIGN KEY (ArtistId) REFERENCES artists (ArtistId)');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E212A9E686A FOREIGN KEY (SupportRepId) REFERENCES employees (EmployeeId)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C30054E08D1 FOREIGN KEY (ReportsTo) REFERENCES employees (EmployeeId)');
        $this->addSql('ALTER TABLE invoice_items ADD CONSTRAINT FK_DCC4B9F8BF8A5EF2 FOREIGN KEY (InvoiceId) REFERENCES invoices (InvoiceId)');
        $this->addSql('ALTER TABLE invoice_items ADD CONSTRAINT FK_DCC4B9F8AE3BCDCC FOREIGN KEY (TrackId) REFERENCES tracks (TrackId)');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F95BE22D475 FOREIGN KEY (CustomerId) REFERENCES customers (CustomerId)');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E52F7AEDBD FOREIGN KEY (PlaylistId) REFERENCES playlists (PlaylistId)');
        $this->addSql('ALTER TABLE playlist_track ADD CONSTRAINT FK_75FFE1E5AE3BCDCC FOREIGN KEY (TrackId) REFERENCES tracks (TrackId)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E945E136F FOREIGN KEY (AlbumId) REFERENCES albums (AlbumId)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E8FE5365C FOREIGN KEY (MediaTypeId) REFERENCES media_types (MediaTypeId)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E86B5F39D FOREIGN KEY (GenreId) REFERENCES genres (GenreId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E945E136F');
        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474FBE651800');
        $this->addSql('ALTER TABLE invoices DROP FOREIGN KEY FK_6A2F2F95BE22D475');
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E212A9E686A');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C30054E08D1');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E86B5F39D');
        $this->addSql('ALTER TABLE invoice_items DROP FOREIGN KEY FK_DCC4B9F8BF8A5EF2');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E8FE5365C');
        $this->addSql('ALTER TABLE playlist_track DROP FOREIGN KEY FK_75FFE1E52F7AEDBD');
        $this->addSql('ALTER TABLE invoice_items DROP FOREIGN KEY FK_DCC4B9F8AE3BCDCC');
        $this->addSql('ALTER TABLE playlist_track DROP FOREIGN KEY FK_75FFE1E5AE3BCDCC');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE invoice_items');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE media_types');
        $this->addSql('DROP TABLE playlists');
        $this->addSql('DROP TABLE playlist_track');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE tracks');
    }
}
