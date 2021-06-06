<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="ville")
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\Column(name="villeId")
     * @ORM\GeneratedValue
     */
    protected $villeId;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;

    /**
     * @ORM\Column(name="paysId")
     */
    protected $paysId;
    
    
    function getVilleId() {
        return $this->sectionId;
    }
    function getPaysId() {
        return $this->paysId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    
    
    

    function setSectionId($sectionId){
        $this->sectionId = $sectionId;
    }

    function setLibelle($libelle){
        $this->libelle = $libelle;
    }
    
    function setPaysId($paysId){
        $this->paysId = $paysId;
    }
    
}



