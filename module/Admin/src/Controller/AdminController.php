<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\ConditionForm;
use Admin\Form\ContactFormForm;
use Admin\Form\FormationForm;
use Admin\Form\PrestationForm;
use Admin\Form\SectionForm;
use Admin\Form\ModuleForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    
    protected $authService;
    protected $entityManager;
    protected $serviceManager;

    public function __construct($authService,$entityManager,$serviceManager) 
    {
            $this->authService = $authService;
            $this->entityManager = $entityManager;
            $this->serviceManager = $serviceManager;
    
    }

    public function indexAction()
    {
            $slides = $this->entityManager->getRepository(\Admin\Entity\Slides::class)->findBy([],['slidesId'=>'asc']);
            return new ViewModel(
                    [
                            'slides' => $slides,
                    ]
            );
    }

    public function nousConnaitreAction()
    {
            //die("[ellow]"); 
    }


    public function prestationsServiceAction()
    {
        //Nous récuperons les service ici
        $services = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findBy([],['prestationServiceId'=>'asc']);
        //Tableau contenant les services, sections par services y compris
        $tabServices = [];
        //Pour chaque service nous recuperons les sections
        foreach($services as $service)
        {
            $sections = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findBy(['prestationServiceId'=> $service->getServiceId()]);
            $tab = [
                'prestationServiceId' =>  $service->getServiceId(),
                'libelle' =>  $service->getLibelle(),
                'image' =>  $service->getImage(),
                'sections' =>  $sections,
            ];
            array_push($tabServices, $tab);
        }
        //var_dump($tabServices);
        //die();
        return new ViewModel([
            'prestationsServices' => $tabServices,
        ]);
    }

    public function editerPrestationAction()
    {
        $idPrestation = (int)$this->params()->fromRoute('id', -1);
        if ($idPrestation<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $prestation = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findOneBy(['prestationServiceId' => $idPrestation]);
        $form = new PrestationForm();
        
        if ($this->getRequest()->isPost())
        {  
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->updatePrestation($prestation,$data);
                    
                    $message = 'Prestation de service de participation modifiée avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'prestations-service']);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,   
                    ]);
                }
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'prestations-service']);
            }
        } 
        else 
        {
            $form->setData(array(
                'libelle'=>$prestation->getLibelle(),
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }
    public function ajouterPrestationAction()
    {
        $form = new PrestationForm();
        
        if ($this->getRequest()->isPost())
        {  
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->enregistrerPrestation($data);
                    
                    $message = 'Prestation de service de participation ajouter avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'prestations-service']);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,   
                    ]);
                }
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'prestations-service']);
            }
        } 
        else 
        {
            //$form->setData(array(
            //    'libelle'=>$prestation->getLibelle(),
            //));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function voirSectionAction($id)
    {
        //Nous récuperons les service ici
        $service = $this->entityManager->getRepository(\Admin\Entity\Service::class)->find($id);
        //Tableau contenant les services, sections par services y compris
        $tabServices = [];
        $sections = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findOneBy(['prestationServiceId'=> $service->getServiceId()]);
        //Pour chaque service nous recuperons les sections
        
        return new ViewModel([
            'sections' => $sections,
        ]);
    }

    public function contactFormAction()
    {       
            //Si le formulaire n'a pas été posté,
            $form = new ContactFormForm();
            if(!$this->getRequest()->isPost()){
        
                    return new ViewModel([
                        'form' => $form
                    ]);
                }

            // Si on click sur le bouton envoyer(post du formulaire)
            if($this->getRequest()->isPost() && $this->getRequest()->getPost('envoyer'))
            {
                    $datas = $this->params()->fromPost();
                    $form->setData($datas);
                    if(!$form->isValid()){
                            return new ViewModel([
                                    'form' => $form   
                    ]);
                    }
                    $datas = $form->getData();
                    //enregister les données dans la bd, envoyer le mail sur le compte du gestionnaire,
                    $this->serviceManager->envoieContactForm($datas);
                    //afficher le message succès.

                    $message = 'Votre demande a bien été envoyer à GR - Consult';
                    $this->flashMessenger()->addSuccessMessage($message);

                    return $this->redirect()->toRoute('contact', 
                            [
                            'action'=>'modifier',
                            ]); 
            }
    }

    public function contactAction()
    {
            //Si le formulaire n'a pas été posté,
            $form = new ContactFormForm();
            $tabContacts=[];
            $contacts = $this->entityManager->getRepository(\Admin\Entity\Contact::class)->findBy([]);
            foreach($contacts as $contact)
            {
                    $adresse = $this->entityManager->getRepository(\Admin\Entity\ContactLocalisatonAdresse::class)->find($contact->getContactLocalisatonAdresseId());
                    //var_dump($adresse); die();
                    $tab = [
                    'email' =>  $contact->getEmail(),
                    'Telephone' =>  $contact->getTelephone() .' / '.$contact->getFixe() ,
                    'Horaires' =>  $contact->getHoraires(),
                    'adresse' =>  $adresse->getDescription(),
                    
                    ];
                    array_push($tabContacts, $tab);
            }
            $infosContacts =$tabContacts;
            if(!$this->getRequest()->isPost()){
        
                    return new ViewModel([
                        'form' => $form,
                        'infosContacts' => $infosContacts,
                    ]);
                }

            // Si on click sur le bouton envoyer(post du formulaire)
            if($this->getRequest()->isPost() && $this->getRequest()->getPost('envoyer'))
            {
                    $datas = $this->params()->fromPost();
                    $form->setData($datas);
                    
                    if(!$form->isValid()){
                            return new ViewModel([
                                    'form' => $form,
                                    'infosContacts' => $infosContacts,   
                            ]);
                    }
                    $donneesValidees = $form->getData();
                    //var_dump($datas);
                    //die();
                    //enregister les données dans la bd, envoyer le mail sur le compte du gestionnaire,
                    $this->serviceManager->envoieContactForm($datas);
                    //afficher le message succès.

                    $message = 'Votre demande a bien été envoyer à GR - Consult';
                    $this->flashMessenger()->addSuccessMessage($message);

                    return $this->redirect()->toRoute('contact'); 
            }




            //die("[ellow]"); 
            /*

            $infosContact = [
                    'email' =>  'infos@grconsult.ci',    
                    'Telephone' =>  '(+225) 22015889 / 0595407894 ',    
                    'Horaires' =>  'Ouvert Du Lundi au vendredi: 8h-18h',    
            ];
            return new ViewModel([
                    'infosContact' => $infosContact,
            ]);

            */
    }
    public function galerieAction()
    {
            //die("[ellow]"); 
    }

    //Traitement des formations
    public function listeFormationsAction()
    {
            //Nous récuperons les formations ici
        $formations = $this->entityManager->getRepository(\Admin\Entity\Formation::class)->findBy([],['dateCreation'=>'desc']);
        //Tableau contenant les services, sections par services y compris
        
        $tabFormations = [];
        //Pour chaque service nous recuperons les sections
        foreach($formations as $formation)
        {
            //$module = $this->entityManager->getRepository(\Admin\Entity\Module::class)->findOneBy(['formationId'=> $formation->getFormationId()]);
            $type = $this->entityManager->getRepository(\Admin\Entity\TypeFormation::class)->find($formation->getTypeFormationId());
            //$conditions = $this->entityManager->getRepository(\Admin\Entity\ConditionParticipation::class)->findOneBy(['formationId'=> $formation->getFormationId()]);
            $tab = [
                'formation' =>  $formation,
                'type' =>  $type,
            ];
            array_push($tabFormations, $tab);
        }
        //var_dump($tabServices);
        //die();
        return new ViewModel([
            'formations' => $tabFormations,
        ]);
    }

    public function ajouterFormationAction()
    {
        $form = new FormationForm();
        
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->enregistrerFormation($data);
                    
                    $message = 'Formation ajoutée avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                            ['action'=>'liste-formations']);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,  
                    ]);
                } 
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'liste-formations']);  
            }
        } 
        else 
        {
            $typeFormations = $this->entityManager->getRepository(\Admin\Entity\TypeFormation::class)->findBy([],['libelle'=>'asc']);
            $typesFormationsTab = [];
            foreach ($typeFormations as $type) {
                $typesFormationsTab[$type->getId()] = $type->getLibelle();
            }
            $form->get('typeFormationId')->setValueOptions($typesFormationsTab);
            
            /*
            $form->setData(array(
                'full_name'=>$user->getFullName(),
                'email'=>$user->getEmail(),
                'status'=>$user->getStatus(), 
                'roles' => $userRoleIds
            ));
            */
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function ajouterConditionAction()
    {
        $idFormation = (int)$this->params()->fromRoute('id', -1);
        if ($idFormation<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new ConditionForm();
        
        if ($this->getRequest()->isPost())
        {  
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->enregistrerCondition($idFormation,$data);
                    
                    $message = 'Conditions de participation ajoutées avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'voir-formation','id'=>$idFormation]);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,   
                    ]);
                }
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'voir-formation','id'=>$idFormation]);
            }
        } 
        else 
        {
            $niveaux = $this->entityManager->getRepository(\Admin\Entity\Niveau::class)->findBy([],['libelle'=>'asc']);
            $niveauxTab = [];
            foreach ($niveaux as $niveau) {
                $niveauxTab[$niveau->getNiveauId()] = $niveau->getLibelle();
            }

            $form->get('niveau')->setValueOptions($niveauxTab);


            $specialites = $this->entityManager->getRepository(\Admin\Entity\Specialite::class)->findBy([],['libelle'=>'asc']);
            $specialitespecialitessTab = [];
            foreach ($specialites as $specialite) {
                $specialitesTab[$specialite->getSpecialiteId()] = $specialite->getLibelle();
            }
            $form->get('specialite')->setValueOptions($specialitesTab);
            
            /*
            $form->setData(array(
                'full_name'=>$user->getFullName(),
                'email'=>$user->getEmail(),
                'status'=>$user->getStatus(), 
                'roles' => $userRoleIds
            ));
            */
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function editerConditionAction()
    {
        $idCondition = (int)$this->params()->fromRoute('id', -1);
        if ($idCondition<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $condition = $this->entityManager->getRepository(\Admin\Entity\ConditionParticipation::class)->findOneBy(['cndParticipationId' => $idCondition]);
        $form = new ConditionForm();
        
        if ($this->getRequest()->isPost())
        {  
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->updateCondition($condition,$data);
                    
                    $message = 'Conditions de participation ajoutées avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'voir-formation','id'=>$condition->getFormationId()]);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,   
                    ]);
                }
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'voir-formation','id'=>$condition->getFormationId()]);
            }
        } 
        else 
        {
            $niveaux = $this->entityManager->getRepository(\Admin\Entity\Niveau::class)->findBy([],['libelle'=>'asc']);
            $niveauxTab = [];
            foreach ($niveaux as $niveau) {
                $niveauxTab[$niveau->getNiveauId()] = $niveau->getLibelle();
            }

            $form->get('niveau')->setValueOptions($niveauxTab);


            $specialites = $this->entityManager->getRepository(\Admin\Entity\Specialite::class)->findBy([],['libelle'=>'asc']);
            $specialitespecialitessTab = [];
            foreach ($specialites as $specialite) {
                $specialitesTab[$specialite->getSpecialiteId()] = $specialite->getLibelle();
            }
            $form->get('specialite')->setValueOptions($specialitesTab);
            
            
            $form->setData(array(
                'montant'=>$condition->getMontant(),
                'remise'=>$condition->getRemise(),
                'niveau'=>$condition->getNiveau(), 
                'specialite'=>$condition->getSpecialite(), 
                'date'=>$condition->getDate(), 
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }


    public function ajouterModuleAction()
    {
        $idFormation = (int)$this->params()->fromRoute('id', -1);
        if ($idFormation<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new ModuleForm();
        
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                //var_dump($data); die();
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Insert the module.
                    $this->serviceManager->enregistrerModule($idFormation,$data);
                    
                    $message = 'Module ajouté avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                            ['action'=>'voir-formation','id'=>$idFormation]);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,
                        [
                            'id'=>$idFormation
                        ]  
                    ]);
                } 
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-formation','id'=>$idFormation]);  
            }
        } 
        else 
        {
            return new ViewModel([
                'form' =>$form,
                    [
                        'id'=>$idFormation
                    ]
            ]);
        }
        
    }

    public function editerModuleAction()
    {
        //$idFormation = (int)$this->params()->fromRoute('idFormation', -1);
        $idModule = (int)$this->params()->fromRoute('id', -1);
        if ($idModule<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //var_dump($idFormation);die();
        $form = new ModuleForm();
        $module = $this->entityManager->getRepository(\Admin\Entity\Module::class)->findOneBy(['moduleId' => $idModule]);
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                //var_dump($data); die();
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    ////var_dump($module);die();
                    // Update the module.
                    $this->serviceManager->updateModule($module,$data);
                    
                    $message = 'Module modifié avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                            ['action'=>'voir-formation','id'=>$module->getFormationId()]);                
                }
                else
                {
                    return new ViewModel([
                        'form' => $form,
                        [
                            'id'=>$idModule
                        ]   
                    ]);
                }
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-formation','id'=>$module->getFormationId()]);  
            }
        } 
        else 
        {
            $form->setData(array(
                'libelle'=>$module->getLibelle(),
                'contenu'=>$module->getContenu(),
                'cout'=>$module->getCout(),
            ));

            return new ViewModel([
                'form' =>$form,
                    [
                        'id'=>$module->getModuleId()
                    ]
            ]);
        }
        
    }


    public function editerFormationAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $formation = $this->entityManager->getRepository(\Admin\Entity\Formation::class)->findOneBy(['formationId' => $id]);

        $form = new FormationForm();
        
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $this->serviceManager->updateFormation($formation,$data);
                    
                    $message = 'Formation modifiée avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                            ['action'=>'liste-formations']);                
                }  
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                            ['action'=>'liste-formations']);  
            }
        } 
        else 
        {
            $typeFormations = $this->entityManager->getRepository(\Admin\Entity\TypeFormation::class)->findBy([],['libelle'=>'asc']);
            $typesFormationsTab = [];
            foreach ($typeFormations as $type) {
                $typesFormationsTab[$type->getId()] = $type->getLibelle();
            }
            $form->get('typeFormationId')->setValueOptions($typesFormationsTab);
            
            
            $form->setData(array(
                'libelle'=>$formation->getLibelle(),
                'dateDebut'=>$formation->getDateDebut(),
                'dateFin'=>$formation->getDateFin(),
                'lieu'=>$formation->getLieu(),
                'dateCreation'=>$formation->getDateCreation(), 
                'typeFormationId' => $formation->getTypeFormationId()
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }


    }



    public function editerSectionAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $section = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findOneBy(['sectionId' => $id]);
        $prestation = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findOneBy(['prestationServiceId' => $section->getPrestationServiceId()]);

        $form = new SectionForm();
        
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    $this->serviceManager->updateSection($section,$data);
                    
                    $message = 'Section modifiée avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'voir-prestation','id'=>$prestation->getServiceId()]);                
                }  
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-prestation','id'=>$prestation->getServiceId()]);  
            }
        } 
        else 
        {
            $form->setData(array(
                'libelle'=>$section->getLibelle(),
                'text'=>$section->getText(),
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }


    }
    public function ajouterSectionAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        //$section = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findOneBy(['sectionId' => $id]);
        $prestation = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findOneBy(['prestationServiceId' =>$id]);

        $form = new SectionForm();
        
        if ($this->getRequest()->isPost())
        {   
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    $this->serviceManager->enregistrerSection($prestation,$data);
                    
                    $message = 'Section ajoutée avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('admin', 
                    ['action'=>'voir-prestation','id'=>$prestation->getServiceId()]);                
                }  
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-prestation','id'=>$prestation->getServiceId()]);  
            }
        } 
        else 
        {
            //$form->setData(array(
            //    'libelle'=>$section->getLibelle(),
            //    'text'=>$section->getText(),
            //));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }


    }


    public function supprimerFormationAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
            //Nous récuperons les formations ici
        $formation = $this->entityManager->getRepository(\Admin\Entity\Formation::class)->findOneBy(['formationId' => $id]);
        $this->serviceManager->supprimerEntity($formation);
        $message = 'Formation supprimée avec succès.';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('admin', 
                ['action'=>'liste-formations']);   
    }


    public function supprimerPrestationAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
            //Nous récuperons les formations ici
        $prestation = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findOneBy(['prestationServiceId' => $id]);
        $this->serviceManager->supprimerEntity($prestation);
        $message = 'Prestation de service supprimée avec succès.';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('admin', 
                ['action'=>'prestations-service']);   
    }

    public function supprimerModuleAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $module = $this->entityManager->getRepository(\Admin\Entity\Module::class)->findOneBy(['moduleId' => $id]);
        $formationId = $module->getFormationId();
        $this->serviceManager->supprimerEntity($module);
        $message = 'Module supprimé avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-formation','id'=>$formationId]);   
    }

    public function supprimerConditionAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $condition = $this->entityManager->getRepository(\Admin\Entity\ConditionParticipation::class)->findOneBy(['cndParticipationId' => $id]);
        $formationId = $condition->getFormationId();
        $this->serviceManager->supprimerEntity($condition);
        $message = 'Conditions de participation supprimées avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-formation','id'=>$formationId]);   
    }


    public function supprimerSectionAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $section = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findOneBy(['sectionId' => $id]);
        $prestationId = $section->getPrestationServiceId();
        $this->serviceManager->supprimerEntity($section);
        $message = 'Section supprimée avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('admin', 
                ['action'=>'voir-prestation','id'=>$prestationId]);   
    }


    public function voirFormationAction()
    {
        if(isset($data['annuler']) && $data['annuler'] !='')
        {
            return $this->redirect()->toRoute('admin', 
                        ['action'=>'liste-formations']);  
        }

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        //Nous récuperons les formations ici
        $formation = $this->entityManager->getRepository(\Admin\Entity\Formation::class)->findOneBy(['formationId'=> $id]);
        //Tableau contenant les services, sections par services y compris
        ////$tabFormations = [];
        //Pour nous recupérons les modules, type et conditions de participation
        
        $modules = $this->entityManager->getRepository(\Admin\Entity\Module::class)->findBy(['formationId'=> $formation->getFormationId()]);
        $type = $this->entityManager->getRepository(\Admin\Entity\TypeFormation::class)->findOneBy(['typeFormationId'=> $formation->getTypeFormationId()]);
        $conditions = $this->entityManager->getRepository(\Admin\Entity\ConditionParticipation::class)->findBy(['formationId'=> $formation->getFormationId()]);
        $tabCond=[];
        foreach($conditions as $condition)
        {
            $niveau = $this->entityManager->getRepository(\Admin\Entity\Niveau::class)->findOneBy(['niveauId'=> $condition->getNiveau()]);
            $specialite = $this->entityManager->getRepository(\Admin\Entity\Specialite::class)->findOneBy(['specialiteId'=> $condition->getSpecialite()]);
            $tabC = [
                'cndParticipationId'=>$condition->getCndParticipationId(),
                'montant'=>$condition->getMontant(),
                'remise'=>(((float)$condition->getRemise()/100)*$condition->getMontant()),
                'date'=>$condition->getDate(),
                'niveau'=>$niveau,
                'profession'=>$specialite,
            ];
            array_push($tabCond,$tabC);
        }
        
        //var_dump($tabCond);die();
        $tabFormations = [
            'formation' =>  $formation,
            'type' =>  $type,
            'modules' =>  $modules,
            'conditions' =>  $tabCond,
        ];
        
        ////var_dump($tabFormations);die();
        return new ViewModel([
            'formation' => $tabFormations,
        ]);
    }


    public function voirPrestationAction()
    {
        if(isset($data['annuler']) && $data['annuler'] !='')
        {
            return $this->redirect()->toRoute('admin', 
                        ['action'=>'prestations-service']);  
        }

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        //Nous récuperons les formations ici
        $prestation = $this->entityManager->getRepository(\Admin\Entity\Service::class)->findOneBy(['prestationServiceId'=> $id]);
        
        $sections = $this->entityManager->getRepository(\Admin\Entity\Section::class)->findBy(['prestationServiceId'=> $prestation->getServiceId()]);
        
        $tabPrestation = [
            'prestation' =>  $prestation,
            'sections' =>  $sections,
        ];
        
        ////var_dump($tabFormations);die();
        return new ViewModel([
            'prestation' => $tabPrestation,
        ]);
    }



    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        return parent::onDispatch($e);
    }

}