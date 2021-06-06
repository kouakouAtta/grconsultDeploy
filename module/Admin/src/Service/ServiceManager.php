<?php
namespace Admin\Service;

use Admin\Entity\ConditionParticipation;
use Admin\Entity\ContactForm;
use Admin\Entity\Formation;
use Admin\Entity\Module;
use Admin\Entity\Service;
use Admin\Entity\Section;
use Admin\Entity\APropos;
use Admin\Entity\ClientsEtPartenaires;
use Admin\Entity\Slides;
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
	
	public function enregistrerSlide($data)
    {
        $slide = new Slides();
        $slide->setImage($data['image']);  
        $slide->setTitre($data['titre']);  
        $slide->setLibelle($data['libelle']);
        $slide->setLibelleBtnService($data['libelleBtnService']);
        $slide->setUrlBtnService($data['UrlBtnService']);
        $slide->setDateCreation($data['DateCreation']);
        $slide->setDateModification($data['DateModification']);
        //Envoie du mail d'abord ici
        $this->entityManager->persist($slide);
        $this->entityManager->flush();
        return $slide;
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

    public function enregistrerCondition($idFormation,$data)
    {
        $module = new ConditionParticipation();
        $module->setMontant($data['montant']);  
        $module->setRemise($data['remise']);  
        $module->setNiveau($data['niveau']);
        $module->setSpecialite($data['specialite']);
        $module->setDate($data['date']);
        $module->setFormationId($idFormation);
        //Envoie du mail d'abord ici
        $this->entityManager->persist($module);
        $this->entityManager->flush();
        return $module;
    }

    public function enregistrerModule($idFormation,$data)
    {
        $module = new Module();
        $module->setLibelle($data['libelle']);  
        $module->setContenu($data['contenu']);  
        $module->setCout($data['cout']);
        $module->setFormationId($idFormation);
        //Envoie du mail d'abord ici
        $this->entityManager->persist($module);
        $this->entityManager->flush();
        return $module;
    }

    public function enregistrerSection($prestation,$data)
    {
        $section = new Section();
        $section->setLibelle($data['libelle']);  
        $section->setText($data['text']);
        $section->setPrestationServiceId($prestation->getServiceId());
        //Envoie du mail d'abord ici
        $this->entityManager->persist($section);
        $this->entityManager->flush();
        return $section;
    }

    public function enregistrerPrestation($data)
    {
        $prestation = new Service();
        $prestation->setLibelle($data['libelle']);
        //Envoie du mail d'abord ici
        $this->entityManager->persist($prestation);
        $this->entityManager->flush();
        return $prestation;
    }

    public function updateModule($module,$data)
    {
        //$module = new Module();
        $module->setLibelle($data['libelle']);  
        $module->setContenu($data['contenu']);  
        $module->setCout($data['cout']);
        ///$module->setFormationId($idFormation);
        //Envoie du mail d'abord ici
        //$this->entityManager->persist($module);
        $this->entityManager->flush();
        return $module;
    }
    public function updatePrestation($prestation,$data)
    {
        //$module = new Module();
        $prestation->setLibelle($data['libelle']);  
        //$module->setContenu($data['contenu']);  
        //$module->setCout($data['cout']);
        ///$module->setFormationId($idFormation);
        //Envoie du mail d'abord ici
        //$this->entityManager->persist($module);
        $this->entityManager->flush();
        return $prestation;
    }
    public function updateSection($section,$data)
    {
        //$module = new Module();
        $section->setLibelle($data['libelle']);  
        $section->setText($data['text']);  
        //$section->prestationServiceId($data['prestationId']);
        //Envoie du mail d'abord ici
        //$this->entityManager->persist($module);
        $this->entityManager->flush();
        return $section;
    }
    public function updateApropos($apropos,$data)
    {
        $apropos->setTitre($data['titre']);  
        $apropos->setSousTitre($data['sousTitre']);  
        $apropos->setText($data['text']);
        $this->entityManager->flush();
        return $apropos;
    }
    public function updateClient($client,$data)
    {
        $client->setNom($data['nom']);  
        $client->setAbrege($data['abrege']);  
        $client->setImage($data['image']);
        $this->entityManager->flush();
        return $client;
    }
    public function enregistrerApropos($data)
    {
        $apropos = new APropos();
        $apropos->setTitre($data['titre']);  
        $apropos->setSousTitre($data['sousTitre']);  
        $apropos->setText($data['text']);
        $this->entityManager->persist($apropos);
        $this->entityManager->flush();
        return $apropos;
    }
    public function enregistrerClient($data)
    {
        $client = new ClientsEtPartenaires();
        $client->setNom($data['nom']);  
        $client->setAbrege($data['abrege']);  
        $client->setImage($data['image']);
        $this->entityManager->persist($client);
        $this->entityManager->flush();
        return $client;
    }
    

    public function updateCondition($condition,$data)
    {
        //$module = new Module();
        $condition->setMontant($data['montant']);  
        $condition->setRemise($data['remise']);  
        $condition->setNiveau($data['niveau']);
        $condition->setSpecialite($data['specialite']);
        $condition->setDate($data['date']);
        ///$module->setFormationId($idFormation);
        //Envoie du mail d'abord ici
        //$this->entityManager->persist($module);
        $this->entityManager->flush();
        return $condition;
    }

    public function updateFormation($formation,$data)
    {
        //$formation = new Formation();
        $formation->setLibelle($data['libelle']);  
        $formation->setDateDebut($data['dateDebut']);  
        $formation->setDateFin($data['dateFin']);
        $formation->setDateCreation(date('Y-m-d'));
        $formation->setLieu($data['lieu']);
        $formation->setTypeFormationId($data['typeFormationId']);
        //Envoie du mail d'abord ici
        //$this->entityManager->persist($formation);
        $this->entityManager->flush();
        return $formation;
    }

    public function supprimerEntity($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
        return 1;
    }
    
}



