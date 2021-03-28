<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="media")
 */
class Media
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="mediaId")
     * @ORM\GeneratedValue
     */
    protected $mediaId;
    /**
     * @ORM\Column(name="scrName")
     */
    protected $scrName;
    /**
     * @ORM\Column(name="dateCreation")
     */
    protected $dateCreation;
    /**
     * @ORM\Column(name="typeMadiaId")
     */
    protected $typeMadiaId;
    /**
     * @ORM\Column(name="galerieId")
     */
    protected $galerieId;
    
    
    
    //Les getters
    function getMediaId() {
        return $this->mediaId;
    }
    function getScrName(){
        return $this->scrName;
    }
    function getDateCreation(){
        return $this->dateCreation;
    }
    function getTypeMadiaId(){
        return $this->typeMadiaId;
    }
    function getGalerieId(){
        return $this->galerieId;
    }
    

    function setMediaId($mediaId) {
        $this->mediaId = $mediaId;
    }
    function setScrName($scrName) {
         $this->scrName = $scrName;
    }
    function setDateCreation($dateCreation) {
         $this->dateCreation = $dateCreation;
    }
    function setTypeMadiaId($typeMadiaId) {
         $this->typeMadiaId = $typeMadiaId;
    }
    function setGalerieId($galerieId) {
         $this->galerieId = $galerieId;
    }
}



