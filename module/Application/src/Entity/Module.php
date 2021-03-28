<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="module")
 */
class Module
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="moduleId")
     * @ORM\GeneratedValue
     */
    protected $moduleId;
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    /**
     * @ORM\Column(name="contenu")
     */
    protected $contenu;
    /**
     * @ORM\Column(name="formationId")
     */
    protected $formationId;
    
    
    
    //Les getters
    function getModuleId() {
        return $this->moduleId;
    }
    function getLibelle(){
        return $this->libelle;
    }
    function getContenu(){
        return $this->contenu;
    }
    function getFormationId(){
        return $this->formationId;
    }
    

    function setModuleId($moduleId) {
        $this->moduleId = $moduleId;
    }
    function setLibelle($libelle) {
         $this->libelle = $libelle;
    }
    function setContenu($contenu) {
         $this->contenu = $contenu;
    }
    function setFormationId($formationId) {
         $this->formationId = $formationId;
    }
}



