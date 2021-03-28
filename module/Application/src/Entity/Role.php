<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="role")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column(name="roleId")
     * @ORM\GeneratedValue
     */
    protected $roleId;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    
    
    
    function getRoleId() {
        return $this->roleId;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
}



