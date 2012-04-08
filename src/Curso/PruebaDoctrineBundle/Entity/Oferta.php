<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso\PruebaDoctrineBundle\Entity\Oferta
 *
 * @ORM\Table(name="Oferta")
 * @ORM\Entity
 */
class Oferta
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var text $condiciones
     *
     * @ORM\Column(name="condiciones", type="text", nullable=false)
     */
    private $condiciones;

    /**
     * @var string $foto
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=false)
     */
    private $foto;

    /**
     * @var decimal $precio
     *
     * @ORM\Column(name="precio", type="decimal", nullable=false)
     */
    private $precio;

    /**
     * @var decimal $descuento
     *
     * @ORM\Column(name="descuento", type="decimal", nullable=false)
     */
    private $descuento;

    /**
     * @var datetime $fechaPublicacion
     *
     * @ORM\Column(name="fecha_publicacion", type="datetime", nullable=true)
     */
    private $fechaPublicacion;

    /**
     * @var datetime $fechaExpiracion
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime", nullable=true)
     */
    private $fechaExpiracion;

    /**
     * @var integer $compras
     *
     * @ORM\Column(name="compras", type="integer", nullable=false)
     */
    private $compras;

    /**
     * @var integer $umbral
     *
     * @ORM\Column(name="umbral", type="integer", nullable=false)
     */
    private $umbral;

    /**
     * @var boolean $revisada
     *
     * @ORM\Column(name="revisada", type="boolean", nullable=false)
     */
    private $revisada;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="oferta")
     * @ORM\JoinTable(name="Venta",
     *   joinColumns={
     *     @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   }
     * )
     */
    private $usuario;

    /**
     * @var Tienda
     *
     * @ORM\ManyToOne(targetEntity="Tienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tienda_id", referencedColumnName="id")
     * })
     */
    private $tienda;

    /**
     * @var Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

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
     * Set nombre
     *
     * @param string $nombre
     * @return Oferta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Oferta
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set descripcion
     *
     * @param text $descripcion
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return text 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set condiciones
     *
     * @param text $condiciones
     * @return Oferta
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;
        return $this;
    }

    /**
     * Get condiciones
     *
     * @return text 
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Oferta
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set precio
     *
     * @param decimal $precio
     * @return Oferta
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * Get precio
     *
     * @return decimal 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param decimal $descuento
     * @return Oferta
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
        return $this;
    }

    /**
     * Get descuento
     *
     * @return decimal 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set fechaPublicacion
     *
     * @param datetime $fechaPublicacion
     * @return Oferta
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return datetime 
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set fechaExpiracion
     *
     * @param datetime $fechaExpiracion
     * @return Oferta
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return datetime 
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set compras
     *
     * @param integer $compras
     * @return Oferta
     */
    public function setCompras($compras)
    {
        $this->compras = $compras;
        return $this;
    }

    /**
     * Get compras
     *
     * @return integer 
     */
    public function getCompras()
    {
        return $this->compras;
    }

    /**
     * Set umbral
     *
     * @param integer $umbral
     * @return Oferta
     */
    public function setUmbral($umbral)
    {
        $this->umbral = $umbral;
        return $this;
    }

    /**
     * Get umbral
     *
     * @return integer 
     */
    public function getUmbral()
    {
        return $this->umbral;
    }

    /**
     * Set revisada
     *
     * @param boolean $revisada
     * @return Oferta
     */
    public function setRevisada($revisada)
    {
        $this->revisada = $revisada;
        return $this;
    }

    /**
     * Get revisada
     *
     * @return boolean 
     */
    public function getRevisada()
    {
        return $this->revisada;
    }

    /**
     * Add usuario
     *
     * @param Curso\PruebaDoctrineBundle\Entity\Usuario $usuario
     */
    public function addUsuario(\Curso\PruebaDoctrineBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set tienda
     *
     * @param Curso\PruebaDoctrineBundle\Entity\Tienda $tienda
     * @return Oferta
     */
    public function setTienda(\Curso\PruebaDoctrineBundle\Entity\Tienda $tienda = null)
    {
        $this->tienda = $tienda;
        return $this;
    }

    /**
     * Get tienda
     *
     * @return Curso\PruebaDoctrineBundle\Entity\Tienda 
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set ciudad
     *
     * @param Curso\PruebaDoctrineBundle\Entity\Ciudad $ciudad
     * @return Oferta
     */
    public function setCiudad(\Curso\PruebaDoctrineBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;
        return $this;
    }

    /**
     * Get ciudad
     *
     * @return Curso\PruebaDoctrineBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
    
    public function getNombreUsuario(){
        
        return 'Usuario> '. $this->usuario[0]->getNombre();
    }
}