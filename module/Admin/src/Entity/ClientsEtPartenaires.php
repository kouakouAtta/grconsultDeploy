<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a clientsetprestataires.
 * @ORM\Entity()
 * @ORM\Table(name="clientsetpartenaires")
 */
class ClientsEtPartenaires
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="clientsEtPartenairesId")
     * @ORM\GeneratedValue
     */
    protected $clientsEtPartenairesId;
    
    /**
     * @ORM\Column(name="image")
     */
    protected $image;

    /**
     * @ORM\Column(name="nom")
     */
    protected $nom;

    /**
     * @ORM\Column(name="abrege")
     */
    protected $abrege;
    
    
    
    //Les getters
    function getClientsEtPartenairesId() {
        return $this->clientsEtPartenairesId;
    }
    function getImage(){
        return $this->image;
    }
    function getNom(){
        return $this->nom;
    }
    function getAbrege(){
        return $this->abrege;
    }
    
    
    //Les setters
    function setClientsEtPartenairesId($clientsEtPartenairesId) {
        $this->clientsEtPartenairesId = $clientsEtPartenairesId;
    }
    function setImage($image){
        $this->image = $image;
    }
    function setNom($nom){
        $this->nom = $nom;
    }
    function setAbrege($abrege){
        $this->abrege = $abrege;
    }
    
    
    
}



