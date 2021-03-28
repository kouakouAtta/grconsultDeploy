<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="pays")
 */
class Permission
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="paysId")
     * @ORM\GeneratedValue
     */
    protected $paysId;
    /**
     * @ORM\Column(name="codeFr")
     */
    protected $codeFr;
    /**
     * @ORM\Column(name="codeEn")
     */
    protected $codeEn;
    /**
     * @ORM\Column(name="libelleEn")
     */
    protected $libelleEn;
    /**
     * @ORM\Column(name="libelleFr")
     */
    protected $libelleFr;
    
    
    //Les getters
    function getPaysId() {
        return $this->paysId;
    }
    function getCodeFr() {
        return $this->codeFr;
    }
    function getCodeEn() {
        return $this->codeEn;
    }
    function getLibelleEn() {
        return $this->libelleEn;
    }
    function getLibelleFr() {
        return $this->libelleFr;
    }
    

    function setPaysId($paysId) {
        $this->paysId = $paysId;
    }

    function setCodeEn($codeEn) {
         $this->codeEn = $codeEn;
    }
    function setCodeFr($codeFr) {
         $this->codeFr = $codeFr;
    }
    function setLibelleEn($libelleEn) {
         $this->libelleEn = $libelleEn;
    }
    function setLibelleFr($libelleFr) {
         $this->libelleFr = $libelleFr;
    }
}



