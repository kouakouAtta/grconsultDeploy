<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a clientsetprestataires.
 * @ORM\Entity()
 * @ORM\Table(name="clientsetprestataires")
 */
class ClientsEtPrestataires
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="clientsEtPrestatairesId")
     * @ORM\GeneratedValue
     */
    protected $clientsEtPrestatairesId;
    
    /**
     * @ORM\Column(name="image")
     */
    protected $image;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="titre")
     */
    protected $titre;

    /**
     * @ORM\Column(name="slogan")
     */
    protected $slogan;
    
    
    
    //Les getters
    function getClientsEtPrestatairesId() {
        return $this->clientsEtPrestatairesId;
    }
    function getImage(){
        return $this->image;
    }
    function getDescription(){
        return $this->description;
    }
    function getTitre(){
        return $this->titre;
    }
    function getSlogan(){
        return $this->slogan;
    }
    
    
    //Les setters
    function setClientsEtPrestatairesId($clientsEtPrestatairesId) {
        $this->clientsEtPrestatairesId = $clientsEtPrestatairesId;
    }
    function setImage($image){
        $this->image = $image;
    }
    function setDescription($description){
        $this->description = $description;
    }
    function setTitre($titre){
        $this->titre = $titre;
    }
    function setSlogan($slogan){
        $this->slogan = $slogan;
    }
    
    
    
}



