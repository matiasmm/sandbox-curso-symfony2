<?php

namespace Curso\PruebaDoctrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities
 *
 * @ORM\Table(name="acl_object_identities")
 * @ORM\Entity
 */
class AclObjectIdentities
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
     * @var integer $classId
     *
     * @ORM\Column(name="class_id", type="integer", nullable=false)
     */
    private $classId;

    /**
     * @var string $objectIdentifier
     *
     * @ORM\Column(name="object_identifier", type="string", length=100, nullable=false)
     */
    private $objectIdentifier;

    /**
     * @var boolean $entriesInheriting
     *
     * @ORM\Column(name="entries_inheriting", type="boolean", nullable=false)
     */
    private $entriesInheriting;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AclObjectIdentities", inversedBy="objectentity")
     * @ORM\JoinTable(name="acl_object_identity_ancestors",
     *   joinColumns={
     *     @ORM\JoinColumn(name="object_identity_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ancestor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ancestor;

    /**
     * @var AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_object_identity_id", referencedColumnName="id")
     * })
     */
    private $parentObjectentity;

    public function __construct()
    {
        $this->ancestor = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set classId
     *
     * @param integer $classId
     * @return AclObjectIdentities
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
        return $this;
    }

    /**
     * Get classId
     *
     * @return integer 
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set objectIdentifier
     *
     * @param string $objectIdentifier
     * @return AclObjectIdentities
     */
    public function setObjectIdentifier($objectIdentifier)
    {
        $this->objectIdentifier = $objectIdentifier;
        return $this;
    }

    /**
     * Get objectIdentifier
     *
     * @return string 
     */
    public function getObjectIdentifier()
    {
        return $this->objectIdentifier;
    }

    /**
     * Set entriesInheriting
     *
     * @param boolean $entriesInheriting
     * @return AclObjectIdentities
     */
    public function setEntriesInheriting($entriesInheriting)
    {
        $this->entriesInheriting = $entriesInheriting;
        return $this;
    }

    /**
     * Get entriesInheriting
     *
     * @return boolean 
     */
    public function getEntriesInheriting()
    {
        return $this->entriesInheriting;
    }

    /**
     * Add ancestor
     *
     * @param Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities $ancestor
     */
    public function addAclObjectIdentities(\Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities $ancestor)
    {
        $this->ancestor[] = $ancestor;
    }

    /**
     * Get ancestor
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }

    /**
     * Set parentObjectentity
     *
     * @param Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities $parentObjectentity
     * @return AclObjectIdentities
     */
    public function setParentObjectentity(\Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities $parentObjectentity = null)
    {
        $this->parentObjectentity = $parentObjectentity;
        return $this;
    }

    /**
     * Get parentObjectentity
     *
     * @return Curso\PruebaDoctrineBundle\Entity\AclObjectIdentities 
     */
    public function getParentObjectentity()
    {
        return $this->parentObjectentity;
    }
}