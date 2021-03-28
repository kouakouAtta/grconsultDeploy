<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="typeformation")
 */
class TypeFormation
{
    /**
     * @ORM\Id
     * @ORM\Column(name="typeFormationId")
     * @ORM\GeneratedValue
     */
    protected $typeFormationId;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    
    
    
    
    function getId() {
        return $this->typeFormationId;
    }

    function getLibelle() {
        return $this->libelle;
    }
    

    function setId($typeFormationId) {
        $this->typeFormationId = $typeFormationId;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
}



