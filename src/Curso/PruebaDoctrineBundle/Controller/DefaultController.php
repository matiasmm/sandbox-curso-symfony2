<?php

namespace Curso\PruebaDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


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
    public function listadoOfertasAction(){
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
    public function listadoOfertasWithJoinsAction(){
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
    public function dqlCountAction(){
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
    public function hidratandoUnArregloAction(){
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
}
