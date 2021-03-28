<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="typemedia")
 */
class TypeMedia
{
    /**
     * @ORM\Id
     * @ORM\Column(name="typeMadiaId")
     * @ORM\GeneratedValue
     */
    protected $typeMadiaId;

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
    

    function setId($typeMadiaId) {
        $this->typeMadiaId = $typeMadiaId;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
}



