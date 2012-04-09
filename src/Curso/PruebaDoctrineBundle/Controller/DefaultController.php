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
    
    
    public function insertAction(){
        $em = $this->getDoctrine()->getEntityManager();
        
        // Nuevo
        $oferta = new Entity\Oferta();
        $oferta->setNombre('matias');
        $oferta->setSlug('matias');
        
        // Attached
        $em->persist($oferta); // Todavia no se ejecuto ninguna consulta
        
        
    }
    
    
}