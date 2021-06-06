<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a slides.
 * @ORM\Entity()
 * @ORM\Table(name="slides")
 */
class Slides
{   
    //Les attributs

    /**
     * @ORM\Id
     * @ORM\Column(name="slidesId")
     * @ORM\GeneratedValue
     */
    protected $slidesId;
    
    /**
     * @ORM\Column(name="image")
     */
    protected $image;

    /**
     * @ORM\Column(name="titre")
     */
    protected $titre;
    /**
     * @ORM\Column(name="libelle")
     */
    protected $libelle;

    /**
     * @ORM\Column(name="libelleBtnService")
     */
    protected $libelleBtnService;

    /**
     * @ORM\Column(name="UrlBtnService")
     */
    protected $UrlBtnService;
    /**
     * @ORM\Column(name="DateCreation")
     */
    protected $DateCreation;
    /**
     * @ORM\Column(name="DateModification")
     */
    protected $DateModification;
    
    
    //Les getters
    function getSlidesId() {
        return $this->slidesId;
    }
    function getImage(){
        return $this->image;
    }
    function getTitre(){
        return $this->titre;
    }
    function getLibelle(){
        return $this->libelle;
    }
    function getLibelleBtnService(){
        return $this->libelleBtnService;
    }
    function getUrlBtnService(){
        return $this->UrlBtnService;
    }
    function getDateCreation(){
        return $this->DateCreation;
    }
    function getDateModification(){
        return $this->DateModification;
    }
    
    //Les setters
    function setSlidesId($slidesId) {
        $this->slidesId = $slidesId;
    }
    function setImage($image){
        $this->image = $image;
    }
    function setTitre($titre){
        $this->titre = $titre;
    }
    function setLibelle($libelle){
        $this->libelle = $libelle;
    }
    function setLibelleBtnService($libelleBtnService){
        $this->libelleBtnService = $libelleBtnService;
    }
    function setUrlBtnService($UrlBtnService){
        $this->UrlBtnService = $UrlBtnService;
    }
    function setDateCreation($DateCreation){
        $this->DateCreation = $DateCreation;
    }
    function setDateModification($DateModification){
        $this->DateModification = $DateModification;
    }
    
    
}



