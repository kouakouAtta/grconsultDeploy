<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{

    // User status constants.
    const STATUS_ACTIVE       = 1; // Active user.
    const STATUS_RETIRED      = 2; // Retired user.
    
    /**
     * @ORM\Id
     * @ORM\Column(name="userId")
     * @ORM\GeneratedValue
     */
    protected $userId;

    /**
     * @ORM\Column(name="nom")
     */
    protected $nom;
    /**
     * @ORM\Column(name="prenoms")
     */
    protected $prenoms;
    /**
     * @ORM\Column(name="password")
     */
    protected $password;
    /**
     * @ORM\Column(name="email")
     */
    protected $email;
    

    /**
     * @ORM\Column(name="status")
     */
    protected $status;


    /**
     * @ORM\Column(name="token")
     */
    protected $token;

    /**
     * @ORM\ManyToMany(targetEntity="Admin\Entity\Role")
     * @ORM\JoinTable(name="user_role",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="userId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="roleId")}
     *      )
     */
    private $roles;

    public function __construct() 
    {
        $this->roles = new ArrayCollection();
    }   
     
    
    function getUserId() {
        return $this->userId;
    }
    function getNom() {
        return $this->nom;
    }
    function getPrenoms() {
        return $this->prenoms;
    }
    function getPassword() {
        return $this->password;
    }
    function getEmail() {
        return $this->email;
    }
    function getToken() {
        return $this->token;
    }

    public function getStatus() 
    {
        return $this->status;
    }


    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Assigns a role to user.
     */
    public function addRole($role)
    {
        $this->roles->add($role);
    }
    
    public function getRolesAsString()
    {
        $roleList = '';
        
        $count = count($this->roles);
        $i = 0;
        foreach ($this->roles as $role) {
            $roleList .= $role->getLibelle();
            if ($i<$count-1)
                $roleList .= ', ';
            $i++;
        }
        
        return $roleList;
    }


    public static function getStatusList() 
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }    
    
    /**
     * Returns user status as string.
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];
        
        return 'Unknown';
    }    
    


    function setUserId($userId) {
        $this->userId = $userId;
    }
    function setNom($nom) {
        $this->nom = $nom;
    }
    function setPrenoms($prenoms){
        $this->prenoms = $prenoms;
    }
    function setPassword($password){
        $this->password = $password;
    }
    function setEmail($email){
        $this->email = $email;
    }
    public function setStatus($status) 
    {
        $this->status = $status;
    } 
    function setToken($token){
        $this->token = $token;
    }
    
}



