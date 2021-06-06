<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a commune.
 * @ORM\Entity()
 * @ORM\Table(name="commune")
 */
class Commune
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="communeId")
     * @ORM\GeneratedValue
     */
    protected $communeId;
    
    /**
     * @ORM\Column(name="nomCommune")
     */
    protected $nomCommune;

    /**
     * @ORM\Column(name="villeId")
     */
    protected $villeId;
    
    
    
    //Les getters
    function getCommuneId() {
        return $this->communeId;
    }
    function getNomCommune(){
        return $this->nomCommune;
    }
    function getVilleId(){
        return $this->villeId;
    }
    
    
    //Les setters
    function setCommuneId($communeId) {
        $this->communeId = $communeId;
    }
    function setNomCommune($nomCommune){
        $this->nomCommune = $nomCommune;
    }
    function setVilleId($villeId){
        $this->villeId = $villeId;
    }
    
    
    
}



