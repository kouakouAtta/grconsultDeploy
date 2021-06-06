<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\AproposForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AproposController extends AbstractActionController
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
            $apropos = $this->entityManager->getRepository(\Admin\Entity\APropos::class)->findBy([],['titre'=>'asc']);
            return new ViewModel(
                    [
                            'apropos' => $apropos,
                    ]
            );
    }

    public function ajouterAproposAction()
    {
        
        $form = new AproposForm();
        
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
                    $this->serviceManager->enregistrerApropos($data);
                    
                    $message = 'Contenu de la page "A Propos" ajouté avec succès';
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



    public function editerAproposAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $apropos = $this->entityManager->getRepository(\Admin\Entity\APropos::class)->findOneBy(['aproposId' => $id]);
        $form = new AproposForm();
        
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
                    $this->serviceManager->updateApropos($apropos,$data);
                    
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
                return $this->redirect()->toRoute('apropos');
            }
        } 
        else 
        {
            $form->setData(array(
                'titre'=>$apropos->getTitre(),
                'sousTitre'=>$apropos->getSousTitre(),
                'text'=>$apropos->getText()
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function supprimerAproposAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $apropos = $this->entityManager->getRepository(\Admin\Entity\APropos::class)->findOneBy(['aproposId' => $id]);
        $this->serviceManager->supprimerEntity($apropos);
        $message = 'Contenu de la page "A propos" supprimé avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('apropos');
    }

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        return parent::onDispatch($e);
    }

}