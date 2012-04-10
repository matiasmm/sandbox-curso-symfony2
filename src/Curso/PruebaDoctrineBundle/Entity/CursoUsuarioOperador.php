<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class CursoUsuarioOperador extends CursoUsuario{
    
    
    function __toString(){
        return "Soy operador";
    }
}