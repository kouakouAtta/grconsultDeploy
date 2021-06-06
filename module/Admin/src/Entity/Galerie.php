<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="galerie")
 */
class Galerie
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="galerieId")
     * @ORM\GeneratedValue
     */
    protected $galerieId;
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    /**
     * @ORM\Column(name="formationId")
     */
    protected $formationId;
    
    
    
    
    //Les getters
    function getGalerieId() {
        return $this->galerieId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    function getFormationId(){
        return $this->formationId;
    }
    

    function setGalerieId($galerieId) {
        $this->galerieId = $galerieId;
    }
    function setLibelle($libelle) {
         $this->libelle = $libelle;
    }
    function setFormationId($formationId) {
         $this->formationId = $formationId;
    }
}



