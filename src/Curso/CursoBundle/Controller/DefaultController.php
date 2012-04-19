<?php

namespace Curso\CursoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('CursoBundle:Default:index.html.twig');
    }
    
    public function formAction()
    {
        $form = $this->createForm(new \Curso\PruebaDoctrineBundle\Form\CursoArticuloType());
        
        return $this->render('CursoBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
}
