<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a cnd_participation.
 * @ORM\Entity()
 * @ORM\Table(name="cnd_participation")
 */
class ConditionParticipation
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="cndParticipationId")
     * @ORM\GeneratedValue
     */
    protected $cndParticipationId;
    
    /**
     * @ORM\Column(name="montant")
     */
    protected $montant;

    /**
     * @ORM\Column(name="remise")
     */
    protected $remise;

    /**
     * @ORM\Column(name="niveau")
     */
    protected $niveau;

    /**
     * @ORM\Column(name="profession")
     */
    protected $profession;
    /**
     * @ORM\Column(name="date")
     */
    protected $date;
    /**
     * @ORM\Column(name="formationId")
     */
    protected $formationId;
    
    
    //Les getters
    function getCndParticipationId() {
        return $this->cndParticipationId;
    }
    function getMontant(){
        return $this->montant;
    }
    function getRemise(){
        return $this->remise;
    }
    function getNiveau(){
        return $this->niveau;
    }
    function getProfession(){
        return $this->profession;
    }
    function getDate(){
        return $this->date;
    }
    function getFormationId(){
        return $this->formationId;
    }
    
    //Les setters
    function setCndParticipationId($cndParticipationId) {
        $this->cndParticipationId = $cndParticipationId;
    }
    function setMontant($montant){
        $this->montant = $montant;
    }
    function setRemise($remise){
        $this->remise = $remise;
    }
    function setNiveau($niveau){
        $this->niveau = $niveau;
    }
    function setProfession($profession){
        $this->profession = $profession;
    }
    function setDate($date){
        $this->date = $date;
    }
    function setFormationId($formationId){
        $this->formationId = $formationId;
    }
    
    
}



