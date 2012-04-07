<?php

namespace Curso\PruebaDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('CursoPruebaDoctrineBundle:Default:index.html.twig');
    }
}
