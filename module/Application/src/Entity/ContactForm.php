<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a contactform.
 * @ORM\Entity()
 * @ORM\Table(name="contactform")
 */
class ContactForm
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="contactFormId")
     * @ORM\GeneratedValue
     */
    protected $contactFormId;
    /**
     * @ORM\Column(name="nomUser")
     */
    protected $nomUser;
    /**
     * @ORM\Column(name="EmailUser")
     */
    protected $emailUser;
    /**
     * @ORM\Column(name="sujet")
     */
    protected $sujet;
    /**
     * @ORM\Column(name="Message")
     */
    protected $message;
    
    
    
    
    //Les getters
    function getContactFormId() {
        return $this->contactFormId;
    }
    function getNomUser(){
        return $this->nomUser;
    }
    function getEmailUser(){
        return $this->emailUser;
    }
    function getSujet(){
        return $this->sujet;
    }
    function getMessage(){
        return $this->message;
    }

    //Les setters
    function setContactFormId($contactFormId) {
        $this->contactFormId = $contactFormId;
    }
    function setNomUser($nomUser){
        $this->nomUser = $nomUser;
    }
    function setEmailUser($emailUser){
        $this->emailUser = $emailUser;
    }
    function setSujet($sujet){
        $this->sujet= $sujet;
    }
    function setMessage($message){
        return $this->message= $message;
    }
    
}



