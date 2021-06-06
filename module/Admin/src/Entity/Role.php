<?php
namespace Admin\Entity;
use Doctrine\Common\Collections\ArrayCollection;

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
    

    /**
     * @ORM\ManyToMany(targetEntity="Admin\Entity\Role", inversedBy="childRoles")
     * @ORM\JoinTable(name="role_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="child_role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_role_id", referencedColumnName="id")}
     *      )
     */
    protected $parentRoles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Admin\Entity\Role", mappedBy="parentRoles")
     * @ORM\JoinTable(name="role_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="parent_role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_role_id", referencedColumnName="id")}
     *      )
     */
    protected $childRoles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Admin\Entity\Permission", inversedBy="roles")
     * @ORM\JoinTable(name="permissionrole",
     *      joinColumns={@ORM\JoinColumn(name="roleId", referencedColumnName="roleId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="permissionId", referencedColumnName="permissionId")}
     *      )
     */
    protected $permissions;

    public function __construct() 
    {
        $this->parentRoles = new ArrayCollection();
        $this->childRoles = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }
    
    
    
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



