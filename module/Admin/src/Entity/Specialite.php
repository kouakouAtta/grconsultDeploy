<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a apropos.
 * @ORM\Entity()
 * @ORM\Table(name="specialite")
 */
class Specialite
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="specialiteId")
     * @ORM\GeneratedValue
     */
    protected $specialiteId;
    
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    
    
    //Les getters
    function getSpecialiteId() {
        return $this->specialiteId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    
    
    //Les setters
    function setSpecialiteId($specialiteId) {
        $this->specialiteId = $specialiteId;
    }
    
    function setLibelle($libelle){
        $this->libelle = $libelle;
    }
    
}



