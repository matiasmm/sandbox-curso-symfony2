<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso\PruebaDoctrineBundle\Entity\AclSecurityIdentities
 *
 * @ORM\Table(name="acl_security_identities")
 * @ORM\Entity
 */
class AclSecurityIdentities
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
     * @var string $identifier
     *
     * @ORM\Column(name="identifier", type="string", length=200, nullable=false)
     */
    private $identifier;

    /**
     * @var boolean $username
     *
     * @ORM\Column(name="username", type="boolean", nullable=false)
     */
    private $username;


}