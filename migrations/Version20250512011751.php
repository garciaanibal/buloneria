<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512011751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Inserta usuario administrador inicial';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO user (email, roles, password) 
        VALUES ('superebuloneria@gmail.com', '[\"ROLE_ADMIN\"]', '\$2y\$13\$zq1o4856VgXtYxOSUUPbH.e3mEIAKMYIZpYH4u/XORS72gxK2t4.W')");


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
