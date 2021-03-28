<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="permissionrole")
 */
class PermissionRole
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="permissionId")
     * @ORM\GeneratedValue
     */
    protected $permissionId;

    /**
     * @ORM\Column(name="roleId")
     */
    protected $roleId;

    /**
     * @ORM\Column(name="userId")
     */
    protected $userId;
    
    
    //Les getters
    function getPermissionId() {
        return $this->permissionId;
    }

    function getRoleId() {
        return $this->roleId;
    }
    function getUserId() {
        return $this->userId;
    }
    //Les setters
    function setPermissionId($permissionId) {
         $this->permissionId = $permissionId;
    }

    function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    function setUserId($userId) {
         $this->userId = $userId;
    }
}



