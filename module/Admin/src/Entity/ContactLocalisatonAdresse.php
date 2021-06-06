<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="contactlocalisatonadresse")
 */
class ContactLocalisatonAdresse
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="contactLocalisatonAdresseId")
     * @ORM\GeneratedValue
     */
    protected $contactLocalisatonAdresseId;
    /**
     * @ORM\Column(name="description")
     */
    protected $description;
    /**
     * @ORM\Column(name="quartier")
     */
    protected $quartier;
    /**
     * @ORM\Column(name="villeId")
     */
    protected $villeId;
    /**
     * @ORM\Column(name="paysId")
     */
    protected $paysId;
    /**
     * @ORM\Column(name="communeId")
     */
    protected $communeId;    
    
    
    //Les getters
    function getContactLocalisatonAdresseId() {
        return $this->contactLocalisatonAdresseId;
    }
    function getQuartier(){
        return $this->quartier;
    }
    function getDescription(){
        return $this->description;
    }
    function getPaysId(){
        return $this->paysId;
    }
    function getVilleId(){
        return $this->villeId;
    }
    function getCommuneId(){
        return $this->communeId;
    }
    //Les setters
    function setContactLocalisatonAdresseId($contactLocalisatonAdresseId) {
        $this->contactLocalisatonAdresseId = $contactLocalisatonAdresseId;
    }
    function setQuartier($quartier){
        $this->quartier = $quartier;
    }
    function setDescription($description){
        $this->description = $description;
    }
    function setPaysId($paysId){
        $this->paysId = $paysId;
    }
    function setVilleId($villeId){
        $this->villeId = $villeId;
    }
    function setCommuneId($communeId){
        $this->communeId = $communeId;
    }
    
}



