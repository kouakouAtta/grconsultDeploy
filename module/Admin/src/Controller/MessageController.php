<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\ContactFormForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class MessageController extends AbstractActionController
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
            $msgs = $this->entityManager->getRepository(\Admin\Entity\ContactForm::class)->findBy([],['dateCreation'=>'desc']);
            return new ViewModel(
                    [
                        'msgs' => $msgs,
                    ]
            );
    }



    public function repondreMessageAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $msg = $this->entityManager->getRepository(\Admin\Entity\ContactForm::class)->findOneBy(['contactFormId' => $id]);
        $form = new ContactFormForm();
        
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
                    //$lesDatas = $data;
                    //$this->serviceManager->updateClent($msg,$lesDatas);
                    mail($data['email'],$data['objet'],$data['message']);
                    $message = 'Message envoyé avec succès.';
                    $this->flashMessenger()->addSuccessMessage($message);

                    // Redirect to "liste formations" page
                    return $this->redirect()->toRoute('messages');                
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
                return $this->redirect()->toRoute('messages');
            }
        } 
        else 
        {
            $form->setData(array(
                'nom'=>'G&R Consult',
                'email'=>$msg->getEmailUser(),
            ));
            
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    public function voirMessageAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $msg = $this->entityManager->getRepository(\Admin\Entity\ContactForm::class)->findOneBy(['contactFormId' => $id]);
        return new ViewModel([
            'msg' =>$msg,
        ]);
    }


    public function supprimerMessageAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        //Nous récuperons le module ici
        $msg = $this->entityManager->getRepository(\Admin\Entity\ContactForm::class)->findOneBy(['contactFormId' => $id]);
        $this->serviceManager->supprimerEntity($msg);
        $message = 'Message supprimé avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('messages');
    }

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        return parent::onDispatch($e);
    }

}