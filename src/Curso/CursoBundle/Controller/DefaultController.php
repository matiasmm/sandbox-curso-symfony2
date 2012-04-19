<?php

namespace Curso\CursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('CursoBundle:Default:index.html.twig');
    }
}
