<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a apropos.
 * @ORM\Entity()
 * @ORM\Table(name="niveau")
 */
class Niveau
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="niveauId")
     * @ORM\GeneratedValue
     */
    protected $niveauId;
    
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    

    //Les getters
    function getNiveauId() {
        return $this->niveauId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    
    
    
    //Les setters
    function setNiveauId($niveauId) {
        $this->niveauId = $niveauId;
    }
    function setLibelle($titre){
        $this->titre = $titre;
    }
    
    
    
    
}



