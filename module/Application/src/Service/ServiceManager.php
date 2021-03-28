<?php
namespace Application\Service;

use Application\Entity\ContactForm;
use Doctrine\ORM\Mapping as ORM;


class ServiceManager
{
    //private $authService;
    
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager) 
    {
        //$this->authService = $authService;
        $this->entityManager = $entityManager;
    }

    public function envoieContactForm($data)
    {
        $contactForm = new ContactForm();
        $contactForm->setNomUser($data['nom']);  
        $contactForm->setEmailUser($data['email']);  
        $contactForm->setSujet($data['sujet']);
        $contactForm->setMessage($data['message']);
        //Envoie du mail d'abord ici
        $this->entityManager->persist($contactForm);
        $this->entityManager->flush();
        return $contactForm;
    }
}



