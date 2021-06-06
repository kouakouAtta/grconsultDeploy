<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\SlideForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SlidesController extends AbstractActionController
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
            //var_dump($slides);die();
            return new ViewModel(
                    [
                            'slides' => $slides,
                    ]
            );
    }


    public function voirSlideAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $slide = $this->entityManager->getRepository(\Admin\Entity\Slides::class)->findOneBy(['slidesId'=>$id]);
        
        return new ViewModel([
            'slide' => $slide,
        ]);
    }
    

    public function ajouterSlideAction()
    {
        $form = new SlideForm();
        
        if ($this->getRequest()->isPost())
        {   
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            //var_dump($data) ; die();
            if(isset($data['enregistrer']) && $data['enregistrer'] !='')
            {
                $form->setData($data);
                
                //var_dump($form);die();
                
                if(!$form->isValid())
                {
                    return new ViewModel([
                        'form' => $form,  
                    ]);
                }
                $data = $form->getData();
                var_dump($data);die();
                $donnees  = [
                    'image' => $data['image']['name'],
                    'titre' => $data['titre'],
                    'libelle' => $data['libelle'],
                    'libelleBtnService' => $data['libelleBtn'],
                    'UrlBtnService' => $data['routeBtn'],
                    'DateCreation' => date('Y-m-d'),
                    'DateModification' => date('Y-m-d'),
                ];
                $this->serviceManager->enregistrerSlide($donnees);
                
                $message = 'Slide ajoutée avec succès';
                $this->flashMessenger()->addSuccessMessage($message);

                // Redirect to "liste formations" page
                return $this->redirect()->toRoute('slides');   
                
                
            }
            if(isset($data['annuler']) && $data['annuler'] !='')
            {
                return $this->redirect()->toRoute('slides');  
            }
        } 
        else 
        {
            return new ViewModel([
                'form' =>$form,
            ]);
        }
        
    }

    
    public function editerSlideAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $slide = $this->entityManager->getRepository(\Admin\Entity\Slides::class)->findOneBy(['slidesId'=>$id]);
        $form = new SlideForm();
        
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


    public function supprimerSlideAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $slide = $this->entityManager->getRepository(\Admin\Entity\Slides::class)->findOneBy(['slidesId'=>$id]);
        $this->serviceManager->supprimerEntity($slide);
        $message = 'Slide supprimée avec succès';
        $this->flashMessenger()->addSuccessMessage($message);
        //Redirect to "liste formations" page
        return $this->redirect()->toRoute('slides');   
    }

    

}