<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Curso\PruebaDoctrineBundle\Entity\CursoCategoria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Curso\PruebaDoctrineBundle\Entity\CursoCategoriaRepository")
 */
class CursoCategoria
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     *
     * @Gedmo\Slug(fields={"titulo"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return CursoCategoria
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
    
    public function setSlug($slug){
        $this->slug = $slug;
    }
    
    public function getSlug(){
        return $this->slug;
    }
}