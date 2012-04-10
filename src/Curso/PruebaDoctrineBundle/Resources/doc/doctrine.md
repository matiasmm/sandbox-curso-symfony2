Probando características de Doctrine2
=====================================

Ingeniería inversa
---------------------

  * Genero todas las clases a partir de la bd y las inserto en el CursoPruebaDoctrineBundle 

    php app/console doctrine:mapping:import CursoPruebaDoctrineBundle annotation
    
    Resultado: 
       - [ src/Curso/PruebaDoctrineBundle/ ]

  Si se vuelve a ejecutar reemplaza los archivos generados.

 * Genero los metodos getters and setters de cada entidad

    php app/console generate:doctrine:entities CursoPruebaDoctrineBundle

Listado con DQL
------------------
   - [Default Controller](https://github.com/matubaum/sandbox-curso-symfony2/blob/doctrine/src/Curso/PruebaDoctrineBundle/Controller/DefaultController.php#L22)

Doctrine Extensions [Gedmo]
---------------------------

  * Generamos la clase CursoCategoria

    php app/console doctrine:generate:entity

  * Actualizamos el cambio en la base de datos

    php app/console doctrine:schema:update

Doctrine Migrations
-------------------

  * Volvemos a la ultima version de la BD antes de realizar mofidicaciones

    bin/install.sh

  * Ejecutamos el script para ver las diferencias de la base de datos solo para tener de referencia como ayuda para hacer el archivo de migración.

    php app/console doctrine:schema:update --dump-sql

  * Generamos un archivo de migración vacío.

    php app/console doctrine:migrations:generate

  * Lo completamos con las consultas requeridas para efectuar lo campos y revertirlos

    [app/DoctrineMigrations/Version20120410042407.php](https://github.com/matubaum/sandbox-curso-symfony2/blob/doctrine/app/DoctrineMigrations/Version20120410042407.php)

  * Ejecutamos el archivo de migración

    php app/console doctrine:migrations:migrate