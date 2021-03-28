<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a apropos.
 * @ORM\Entity()
 * @ORM\Table(name="apropos")
 */
class APropos
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="aproposId")
     * @ORM\GeneratedValue
     */
    protected $aproposId;
    
    /**
     * @ORM\Column(name="titre")
     */
    protected $titre;

    /**
     * @ORM\Column(name="sousTitre")
     */
    protected $sousTitre;

    /**
     * @ORM\Column(name="text")
     */
    protected $text;
    
    
    
    //Les getters
    function getAPproposId() {
        return $this->aproposId;
    }
    function getTitre(){
        return $this->titre;
    }
    function getSousTitre(){
        return $this->sousTitre;
    }
    function getText(){
        return $this->text;
    }
    
    
    //Les setters
    function setAProposId($aproposId) {
        $this->aproposId = $aproposId;
    }
    function setTitre($titre){
        $this->titre = $titre;
    }
    function setSousTitre($sousTitre){
        $this->sousTitre = $sousTitre;
    }
    function setText($text){
        $this->text = $text;
    }
    
    
    
}



