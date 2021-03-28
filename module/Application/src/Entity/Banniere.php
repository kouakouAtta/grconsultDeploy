<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a banniere.
 * @ORM\Entity()
 * @ORM\Table(name="banniere")
 */
class Banniere
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="banniereId")
     * @ORM\GeneratedValue
     */
    protected $banniereId;
    
    /**
     * @ORM\Column(name="titre")
     */
    protected $titre;
    
    
    
    //Les getters
    function getBanniereId() {
        return $this->banniereId;
    }
    function getTitre(){
        return $this->titre;
    }
    
    
    //Les setters
    function setBanniereId($banniereId) {
        $this->banniereId = $banniereId;
    }
    function setTitre($titre){
        $this->titre = $titre;
    }
    
    
    
}



