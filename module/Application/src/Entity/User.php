<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{
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
     * @ORM\Column(name="token")
     */
    protected $token;
     
    
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
    function setToken($token){
        $this->token = $token;
    }
    
}



