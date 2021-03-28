<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a product.
 * @ORM\Entity()
 * @ORM\Table(name="prestationservice")
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\Column(name="prestationServiceId")
     * @ORM\GeneratedValue
     */
    protected $prestationServiceId;

    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;
    /**
     * @ORM\Column(name="image")
     */
    protected $image;
    
    
    function getServiceId() {
        return $this->prestationServiceId;
    }

    function getLibelle() {
        return $this->libelle;
    }
    function getImage() {
        return $this->image;
    }

    function setId($prestationServiceId) {
        $this->prestationServiceId = $prestationServiceId;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    function setImage($image) {
        $this->image = $image;
    }
}



