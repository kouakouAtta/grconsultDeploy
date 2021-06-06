<?php namespace Admin\Form;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\InputFilter\InputFilter;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;

/**
 * Description of Contact
 *
 * @author atta
 */
class AproposForm extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'titre',
            'required' => true,
            'options' => [
                'label' => 'Libelle',
            ],
            'attributes' => [
                'id'  => "titre",
                'placeholder' => "inscrivez le libelle",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le libellé'
            ]
        ]);

        $this->add([
            'type'  => Element\Text::class,
            'name' => 'sousTitre',
            'required' => true,
            'options' => [
                'label' => 'Sous Libelle',
            ],
            'attributes' => [
                'id'  => "sousTitre",
                'placeholder' => "inscrivez le libelle",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le libellé'
            ]
        ]);


        $this->add([
            'type'  => Element\Textarea::class,
            'name' => 'text',
            'required' => true,
            'options' => [
                'label' => 'Texte du contenu de la section',
            ],
            'attributes' => [
                'id'  => "text",
                'placeholder' => "Texte du contenu",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le texte du contenu'
            ]
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'annuler',
            'attributes' => [   
                'class'  => 'btn btn-sm btn-warning py-3 px-5',       
                'value' => 'Annuler'
            ],
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'enregistrer',
            'attributes' => [   
                'class'  => 'btn btn-sm btn-success py-3 px-5',       
                'value' => 'Enregistrer'
            ],
        ]);
        
    }
    
    public function getInputFilter(){
        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'name' => 'titre',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'sousTitre',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'text',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);


        return $inputFilter;

    }
    
}
