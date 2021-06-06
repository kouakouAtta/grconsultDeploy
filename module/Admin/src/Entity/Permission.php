<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="permission")
 */
class Permission
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="permissionId")
     * @ORM\GeneratedValue
     */
    protected $permissionId;
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    
    
    //Les getters
    function getPermissionId() {
        return $this->permissionId;
    }
    function getLibelle() {
        return $this->libelle;
    }
    

    function setPermissionId($permissionId) {
        $this->permissionId = $permissionId;
    }

    function setLibelle($libelle) {
         $this->libelle = $libelle;
    }
}



