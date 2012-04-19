<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120418225146 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
        CREATE TABLE CursoUsuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = InnoDB;
        ALTER TABLE CursoArticulo ADD deletedAt DATETIME DEFAULT NULL;
SQL
);
    }

    public function down(Schema $schema)
    {
        $this->addSql(<<<SQL
              ALTER TABLE CursoArticulo DROP COLUMN deletedAt;
              DROP TABLE CursoUsuario;
SQL
);
    }
}
