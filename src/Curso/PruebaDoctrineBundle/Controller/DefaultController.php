<?php

namespace Curso\PruebaDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response,
    Curso\PruebaDoctrineBundle\Entity;


class DefaultController extends Controller
{
    
    
    /**
     * Index de la sección
     * @return type 
     */
    public function indexAction(){
        return $this->render('CursoPruebaDoctrineBundle:Default:index.html.twig');
    }
    
    
    /**
     * Listado de ofertas con DQL
     */
    public function listadoOfertasDQLAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT o FROM CursoPruebaDoctrineBundle:Oferta o');
        
        return $this->render('CursoPruebaDoctrineBundle:Default:list.html.twig', array(
            'collection' => $query->getResult(),
            'columns' => array('id','nombre', 'slug'),
         ));
    }
    
    
    /**
     * Listado de ofertas más complejo con DQL.
     * 
     * Hidrata a la oferta y al usuario contenido en ella porque ambos estan en el SELECT.
     * Ejecuta una sola consulta.
     */
    public function listadoOfertasWithJoinsDQLAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT o, u 
            FROM CursoPruebaDoctrineBundle:Oferta o 
            JOIN o.usuario u
            WHERE o.fechaPublicacion < :fecha
            ORDER BY o.id
            ')
          ->setParameter('fecha', new \DateTime('2012-03-27'));
        
        
        return $this->render('CursoPruebaDoctrineBundle:Default:list.html.twig', array(
            'collection' => $query->getResult(),
            'columns' => array('id','nombre', 'slug', 'nombreUsuario'),
            'column_date' => 'fechaPublicacion',
         ));
    }
    
    
    /***
     * Contador usando DQL
     */
    public function countDQLAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(o.id)
            FROM CursoPruebaDoctrineBundle:Oferta o 
            JOIN o.usuario u
            WHERE o.fechaPublicacion < :fecha
            ORDER BY o.id
            ')
          ->setParameter('fecha', new \DateTime('2012-03-27'));
        
        return new Response($query->getSingleScalarResult());
    }
    
    
    /***
     * Hidratando un arreglo a partir de una consulta
     */
    public function hidratandoUnArregloDQLAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $dql = 'SELECT o.nombre oferta_nombre, t.nombre, COUNT(u.id) as ventas
            FROM CursoPruebaDoctrineBundle:Oferta o JOIN o.tienda t JOIN o.usuario u WHERE o.fechaPublicacion < ?1
            GROUP BY o.id
            ORDER BY o.id
            ';
        $query = $em->createQuery($dql)->setParameter(1, new \DateTime('2012-03-27'));
        
        $result = $query->getArrayResult();
        var_dump($result);
        
        return new Response('');
    }

    
    /**
     * Es lo mismo que hidratandoUnArregloAction pero utilizando el queryBuilder
     * Más info: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html
     * 
     */
    public function hidratandoUnArregloQBAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $queryBuilder = $em->getRepository('CursoPruebaDoctrineBundle:Oferta')->createQueryBuilder('o')
                ->select('o.nombre oferta_nombre', 't.nombre', 'COUNT(u.id)')
                ->join('o.tienda', 't')
                ->join('o.usuario', 'u')
                ->where('o.fechaPublicacion < ?1')
                ->groupBy('o.id')
                ->orderBy('o.id')
            ;
        
        $query = $queryBuilder->getQuery()->setParameter(1, new \DateTime('2012-03-27'));
        
        $result = $query->getArrayResult();
        var_dump($result);
        
        return new Response('');
    }
    
     
    /**
     * Listado de ofertas desde el Repositorio
     */
    public function listadoOfertasRepoAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $collection = $em->getRepository('CursoPruebaDoctrineBundle:Oferta')->findAll();
        
        return $this->render('CursoPruebaDoctrineBundle:Default:list.html.twig', array(
            'collection' => $collection,
            'columns' => array('id','nombre', 'slug'),
         ));
    }   
    
     
    /**
     * Obtiene una oferta desde el repo por slug
     */
    public function obtenerOfertaPorSlugRepoAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $object = $em->getRepository('CursoPruebaDoctrineBundle:Oferta')->findOneBySlug('oferta-ut-enimsit-ipsum-vel-lorem-'); //este metodo no existe realmente
        
        return $this->render('CursoPruebaDoctrineBundle:Default:object.html.twig', array(
            'object' => $object,
            'attributes' => array('id','nombre', 'slug'),
         ));
    }   
    
     
    /**
     * Obtiene una oferta desde el repo por id
     */
    public function obtenerOfertaPorIdRepoAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $object = $em->getRepository('CursoPruebaDoctrineBundle:Oferta')->findOneById(5);
        
        return $this->render('CursoPruebaDoctrineBundle:Default:object.html.twig', array(
            'object' => $object,
            'attributes' => array('id','nombre', 'slug'),
         ));
    }
    
    /**
     * Agregando una nueva oferta 
     */
    public function crearOfertaCRUDAction(){
        $em = $this->getDoctrine()->getEntityManager();
        
        ## Nuevo ##
        $oferta = new Entity\Oferta();
        $oferta->setNombre('prueba');
        $oferta->setSlug('custom-slug');
        $oferta->setDescripcion("dd");
        $oferta->setCondiciones("dd");
        $oferta->setFoto('d');
        $oferta->setPrecio('d');
        $oferta->setDescuento('d');
        $oferta->setCompras('d');
        $oferta->setUmbral('d');
        $oferta->setRevisada('d');
        
        
        ## Manejado ##
        $em->persist($oferta); // Da aviso al EntityManager de la existencia de este nuevo objeto. Ninguna consulta todavia.
        $id_antes_del_flush = $oferta->getId() ?: 'Nada' ;
        
        ## Queries ##
        $em->flush(); // persiste esto en la bd;
        $id_despues_del_flush = $oferta->getId();
        
        
        return new Response(sprintf("Antes del flush: %s, Despues del flush: %s",
                var_export($id_antes_del_flush,true),
                var_export($id_despues_del_flush,true)
        ));
    }
    
    /**
     * Borro una oferta
     */
    public function borrarOfertaCRUDAction(){
        $em = $this->getDoctrine()->getEntityManager();
        
        ## Manejado ##
        $oferta = $em->getRepository('CursoPruebaDoctrineBundle:Oferta')->findOneBySlug('custom-slug');
        if(null === $oferta)
            return new Response('Esta oferta no existe');
        
        ## Removido ##
        $em->remove($oferta); // Ninguna conulta todavia.
        $id_antes_del_flush = $oferta->getId() ;
        
        ## Borrado de la bae de datos ##
        $em->flush();
        $id_despues_del_flush = $oferta->getId();
        
        return new Response(sprintf("Antes del flush: %s, Despues del flush: %s",
                var_export($id_antes_del_flush,true),
                var_export($id_despues_del_flush,true)
        ));
    }
    
    
    /**
     * Sluggable Extension 
     */
    public function sluggableExtensionAction(){
        $em = $this->getDoctrine()->getEntityManager();
        
        $categoria = new Entity\CursoCategoria();
        $categoria->setTitulo("Este titulo deberia ser usado para una url amigable");
        
        $em->persist($categoria);
        $em->flush();
        
        // el slug creado es "este-titulo-deberia-ser-usado-para-una-url-amigable"
        
        return $this->render('CursoPruebaDoctrineBundle:Default:object.html.twig', array(
            'object' => $categoria,
            'attributes' => array('id', 'titulo', 'slug'),
         ));
        
    }
    
    
    /**
     * Loggable Extension 
     */
    public function loggableExtensionAction(){
        $em = $this->getDoctrine()->getEntityManager();
        
        //Busco el articulo con id 1 y si no existe creo uno nuevo
        $articulo = $em->getRepository("CursoPruebaDoctrineBundle:CursoArticulo")->findOneById(1) ?: new Entity\CursoArticulo();
        
        $articulo->setTitulo($articulo->getTitulo() . " ~");
        $articulo->setDescripcion($articulo->getDescripcion() . " ~");
        
        $em->persist($articulo);
        $em->flush();
        
        return $this->render('CursoPruebaDoctrineBundle:Default:object.html.twig', array(
            'object' => $articulo,
            'attributes' => array('id', 'titulo', 'slug'),
         ));
        
    }

    
    
    
    
    
    
    
    
    
}