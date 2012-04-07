Probando características de Doctrine2
=====================================

1. Ingeniería inversa
---------------------

  * Genero todas las clases a partir de la bd y las inserto en el CursoPruebaDoctrineBundle 

    php app/console doctrine:mapping:import CursoPruebaDoctrineBundle annotation
    
    Resultado: 
       - [ src/Curso/PruebaDoctrineBundle/ ]

  Si se vuelve a ejecutar reemplaza los archivos generados.

 * Genero los metodos getters and setters de cada entidad

    php app/console generate:doctrine:entities CursoPruebaDoctrineBundle

2. Listado con DQL
------------------
   - [ src/Curso/PruebaDoctrineBundle/Controller/DefaultController ]
