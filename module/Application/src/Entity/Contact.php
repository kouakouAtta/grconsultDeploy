<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a contact.
 * @ORM\Entity()
 * @ORM\Table(name="contact")
 */
class Contact
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="contactId")
     * @ORM\GeneratedValue
     */
    protected $contactId;

    /**
     * @ORM\Column(name="telephone")
     */
    protected $telephone;

    /**
     * @ORM\Column(name="fixe")
     */
    protected $fixe;

    /**
     * @ORM\Column(name="email")
     */
    protected $email;
    /**
     * @ORM\Column(name="horaires")
     */
    protected $horaires;
    /**
     * @ORM\Column(name="contactLocalisatonAdresseId")
     */
    protected $contactLocalisatonAdresseId;
    
    
    
    
    //Les getters
    function getContactId() {
        return $this->contactId;
    }
    function getTelephone(){
        return $this->telephone;
    }
    function getFixe(){
        return $this->fixe;
    }
    function getEmail(){
        return $this->email;
    }
    function getHoraires(){
        return $this->horaires;
    }
    
    function getContactLocalisatonAdresseId(){
        return $this->contactLocalisatonAdresseId;
    }

    //Les setters
    function setContactId($contactId) {
        $this->contactId = $contactId;
    }
    function setTelephone($telephone){
        $this->telephone = $telephone;
    }
    function setFixe($fixe){
        $this->fixe = $fixe;
    }
    function setEmail($email){
        $this->email = $email;
    }
    function setHoraires($horaires){
        $this->horaires = $horaires;
    }
    function setContactLocalisatonAdresseId($contactLocalisatonAdresseId){
        return $this->contactLocalisatonAdresseId = $contactLocalisatonAdresseId;
    }
    
}



