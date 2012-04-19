<?php

namespace Curso\FormularioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function formAction(Request $request)
    {
        
         $form = $this->createForm(new \Curso\PruebaDoctrineBundle\Form\CursoArticuloType(), array());
         
     
         if("POST" == $request->getMethod()){
             $form->bindRequest($request);
             if($form->isValid()){
                 $data = $form->getData();
                 
                 $this->get('app.business.articulo')->crearNuevo($data);
             }else{
                 
             }
         }
    
        return $this->render('CursoFormularioBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
    
    
    
}
