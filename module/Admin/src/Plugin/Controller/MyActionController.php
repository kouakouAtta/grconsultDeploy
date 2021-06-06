<?php
namespace Application\Plugin\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Result;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;
/**
 * Description of MyActionController
 *
 * @author kjkoffi
 */
class MyActionController extends AbstractActionController {
    //Déclaration des variables globales utilisation par tous les controleur
    public $tableApropos;
    public $tableContact;
    public $tableServices;
    public $tableSlides;
    public $tableCompte;
    
    public $dbAdapter;
    public $auth;
    
    public $listHeadLink;
    public $listHeadScript;
    
    public $view;
    
    public function __construct() {
        $this->listHeadLink = [];
        $this->listHeadScript = [];
        $this->view = new ViewModel();
    }
    
    /**
     * Add a message with "warning" or type
     *
     * @param string        $message
     * @param String        $type       {success, info, warning, error, danger}
     * @return FlashMessenger
     */
    public function flash($message, $type='success'){
        if($type==='success'){
            $this->flashMessenger()->addSuccessMessage($message);
            
        }else if($type==='danger' || $type==='error'){
            $this->flashMessenger()->addErrorMessage($message);
            
        }else if($type==='info'){
            $this->flashMessenger()->addInfoMessage($message);
            
        }else if($type==='warning'){
            $this->flashMessenger()->addWarningMessage($message);
            
        }
        
    }
    
    /**
     * Cette fonction permet de se connecter avec un login et un mot de passe
     *
     * @param string        $login      Nom d'utilisateur
     * @param String        $pwd        Mot de passe
     * @return bool {true/false}
     */
    public function login($login, $pwd){
        $this->auth = new AuthenticationService(); //Récuperation de l'instance d'authentification
        $this->auth->setStorage(new SessionStorage('AuthUserAdmin')); //Création d'une session 'AuthUserAdmin'
        
        //Request d'authentification
        $authAdapter = new AuthAdapter(
            $this->dbAdapter,
            'comptes',
            'email',
            'pwd',
            'MD5(?)'
        );
        $authAdapter->setIdentity($login)->setCredential($pwd); //Affect les paramètres login et pwd à la Request d'authentification
        $result = $this->auth->authenticate($authAdapter); //Tentative d'authentification
        
        if($result->getCode() === Result::SUCCESS){ //Si authentification reussi
            $user = $authAdapter->getResultRowObject(); //Récupération de l'entité authentifié (une ligne de la table compte)
            $this->auth->getStorage()->write([
                'id'    => $user->id,
                'email' => $user->email,
                'nom'   => $user->nom,
                'prenom' => $user->prenom,
                'telephone' => $user->telephone,
            ]);
            return true;

        }else{//Si authentification echou
            return false;
        }
    }
    
    public function getIdentity(){
        $this->auth = new AuthenticationService(); //Récuperation de l'instance d'authentification
        $this->auth->setStorage(new SessionStorage('AuthUserAdmin')); //Création d'une session 'AuthUserAdmin'
        
        return $this->auth->getIdentity();
    }
    
    public function useStyleFile($cssFile){
        //var_dump($this->getRequest()->getBasePath()); die;
        //var_dump($this->layout()->user); die;
        //$this->layout()->headLink()->prependStylesheet($basePath.$cssFile);
        
        $this->listHeadLink[] = $cssFile;
        $this->getEvent()->getApplication()->getMvcEvent()->getViewModel()->setVariables(['listHeadLink' => $this->listHeadLink]);
    }
    
    public function useScriptFile($jsFile){
        //$this->layout()->headScript()->prependFile($basePath.$jsFile);
        
        $this->listHeadScript[] = $jsFile;
        $this->getEvent()->getApplication()->getMvcEvent()->getViewModel()->setVariables(['listHeadScript' => $this->listHeadScript]);
    }
    
    public function redirect($url=null) {
        if($url){
            parent::redirect()->toUrl($this->getRequest()->getBasePath() . $url);
        }else{
            return parent::redirect();
        }
        
    }
}