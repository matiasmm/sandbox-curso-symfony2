<?php
namespace Curso\FormularioBundle\Business;

class ArticuloHandler{
    protected $em;
    
    
    
    function __construct($em){
        
        $this->em = $em;
    }
    
    function crearNuevo($data){
        $entity = new \Curso\PruebaDoctrineBundle\Entity\CursoArticulo();
        $entity->setTitulo($data['titulo']);
        $entity->setDescripcion("descripcion");
         $this->em->persist($entity);
         $this->em->flush();
    }
}