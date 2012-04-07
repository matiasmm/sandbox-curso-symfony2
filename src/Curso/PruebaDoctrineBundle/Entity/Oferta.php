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
     * @ORM\JoinTable(name="venta",
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
    
}