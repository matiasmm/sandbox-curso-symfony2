<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120410042407 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
   CREATE TABLE CursoArticulo (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, 
       descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = InnoDB;
   CREATE TABLE CursoCategoria (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = InnoDB;


SQL
                );

    }

    public function down(Schema $schema)
    {
        $this->addSql(<<<SQL
   DROP TABLE CursoCategoria;
   DROP TABLE CursoArticulo;
SQL
                );

    }
}
