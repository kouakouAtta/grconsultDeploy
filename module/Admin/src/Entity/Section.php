<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="section")
 */
class Section
{
    /**
     * @ORM\Id
     * @ORM\Column(name="sectionId")
     * @ORM\GeneratedValue
     */
    protected $sectionId;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    /**
     * @ORM\Column(name="text")
     */
    protected $text;
    /**
     * @ORM\Column(name="prestationServiceId")
     */
    protected $prestationServiceId;
    
    
    
    
    function getSectionId() {
        return $this->sectionId;
    }
    function getLibelle() {
        return $this->libelle;
    }
    function getText() {
        return $this->text;
    }
    function getPrestationServiceId() {
        return $this->prestationServiceId;
    }
    
    

    function setSectionId($sectionId) {
        $this->sectionId = $sectionId;
    }
    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    function setText($text) {
        $this->text = $text;
    }
    function setPrestationServiceId($prestationServiceId) {
        $this->prestationServiceId = $prestationServiceId;
    }
    
}



