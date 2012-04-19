<?php

namespace Curso\FormularioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function formAction(Request $request)
    {
        
        $entity = new \Curso\PruebaDoctrineBundle\Entity\CursoArticulo();
        
         $form = $this->createForm(new \Curso\PruebaDoctrineBundle\Form\CursoArticuloType(), $entity);
         
         if("POST" == $request->getMethod()){
             $form->bindRequest($request);
             if($form->isValid()){
                 $em = $this->getDoctrine()->getEntityManager();
                 $em->persist($entity);
                 $em->flush();
                 
             }else{
                 
             }
         }
    
        return $this->render('CursoFormularioBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
    
    
    
}
