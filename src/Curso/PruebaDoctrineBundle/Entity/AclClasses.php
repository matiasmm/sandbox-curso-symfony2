<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso\PruebaDoctrineBundle\Entity\AclClasses
 *
 * @ORM\Table(name="acl_classes")
 * @ORM\Entity
 */
class AclClasses
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
     * @var string $classType
     *
     * @ORM\Column(name="class_type", type="string", length=200, nullable=false)
     */
    private $classType;


}