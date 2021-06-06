<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="formation")
 */
class Formation
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="formationId")
     * @ORM\GeneratedValue
     */
    protected $formationId;

    /**
     * @ORM\Column(name="dateDebut")
     */
    protected $dateDebut;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;

    /**
     * @ORM\Column(name="dateFin")
     */
    protected $dateFin;

    /**
     * @ORM\Column(name="lieu")
     */
    protected $lieu;

    /**
     * @ORM\Column(name="dateCreation")
     */
    protected $dateCreation;

    /**
     * @ORM\Column(name="typeFormationId")
     */
    protected $typeFormationId;
    
    
    //Les getters
    function getFormationId() {
        return $this->formationId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    function getTypeFormationId(){
        return $this->typeFormationId;
    }

    function getLieu(){
        return $this->lieu;
    }
    function getDateFin(){
        return $this->dateFin;
    }
    function getDateDebut(){
        return $this->dateDebut;
    }
    function getDateCreation(){
        return $this->dateCreation;
    }
    
    
     //Les setters
    function setFormationId($formationId) {
        $this->formationId = $formationId;
    }
    function setLieu($lieu) {
         $this->lieu = $lieu;
    }
    function setLibelle($libelle) {
         $this->libelle = $libelle;
    }
    function setDateDebut($dateDebut) {
         $this->dateDebut = $dateDebut;
    }
    function setDateFin($dateFin) {
         $this->dateFin = $dateFin;
    }
    function setDateCreation($dateCreation) {
         $this->dateCreation = $dateCreation;
    }
    function setTypeFormationId($typeFormationId) {
         $this->typeFormationId = $typeFormationId;
    }
}



