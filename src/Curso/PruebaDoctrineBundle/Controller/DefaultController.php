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
    
    /***
     * Listado de ofertas con DQL
     */
    public function listadoOfertasAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT o FROM CursoPruebaDoctrineBundle:Oferta o');
        
        return $this->render('CursoPruebaDoctrineBundle:Default:list.html.twig', array(
            'collection' => $query->getResult(),
         ));
    }
}
