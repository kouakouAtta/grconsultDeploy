<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\ClientForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ClientController extends AbstractActionController
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
            $clients = $this->entityManager->getRepository(\Admin\Entity\ClientsEtPartenaires::class)->findBy([],['nom'=>'asc']);
            return new ViewModel(
                    [
                            'clients' => $clients,
                    ]
            );
    }

    public function ajouterClientAction()
    {
        
        $form = new ClientForm();
        
        if ($this->getRequest()->isPost())
        {  
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                // Validate form
                if($form->isValid())
                {
                    // Get filtered and validated data

                    //$data = $form->getData();
                    
                    // Update the user.
                    $lesDatas = $data;
                    $lesDatas['image'] = $data['image']['name'];
                    $this->serviceManager->enregistrerClient($lesDatas);
                    
                    $message = 'Client / Partenaire ajouté avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('clients');                
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
                return $this->redirect()->toRoute('apropos');
            }
        } 
        else 
        {
            /*$form->setData(array(
                'titre'=>$apropos->getTitre(),
                'sousTitre'=>$apropos->getSousTitre(),
                'text'=>$apropos->getText()
            ));*/
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }



    public function editerClientAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $client = $this->entityManager->getRepository(\Admin\Entity\ClientsEtPartenaires::class)->findO/neBy(['clientsEtPartenairesId' => $id]);
        $form = new ClientForm();
        
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
                    $lesDatas = $data;
                    $lesDatas['image'] = $data['image']['name'];
                    $this->serviceManager->updateClent($client,$lesDatas);
                    
                    $message = 'Contenu de la page "A Propos" modifié avec succès';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('apropos');                
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
                return $this->redirect()->toRoute('clients');
            }
        } 
        else 
        {
            $form->setData(array(
                'image'=>$client->getImage(),
                'nom'=>$client->getNom(),
                'abrege'=>$client->getAbrege()
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function supprimerClientAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $client = $this->entityManager->getRepository(\Admin\Entity\ClientsEtPartenaires::class)->findOneBy(['clientsEtPartenairesId' => $id]);
        $this->serviceManager->supprimerEntity($client);
        $message = 'Client / Partenaire supprimé avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('clients');
    }

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        return parent::onDispatch($e);
    }

}