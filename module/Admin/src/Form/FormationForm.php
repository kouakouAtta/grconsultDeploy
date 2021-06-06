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
class FormationForm extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'libelle',
            'required' => true,
            'options' => [
                'label' => 'Intitulé de la formation',
            ],
            'attributes' => [
                'id'  => "libelle",
                'placeholder' => "Formation sur le devéloppement personnelle",
                'class' => "form-control",
                'data-rule' => 'minlen:4',
                'data-msg' => 'Veuillez renseignez l\'intitulé de la formation'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Date::class,
            'name' => 'dateDebut',
            'required' => true,
            'options' => [
                'label' => 'Date de debut de la formation',
            ],
            'attributes' => [
                'id'  => "dateDebut",
                'placeholder' => "02/01/2021",
                'class' => "form-control",
                'data-rule' => 'date',
                'data-msg' => 'Veuillez renseignez la date de début'
            ]
        ]);

        $this->add([
            'type'  => Element\Date::class,
            'name' => 'dateFin',
            'required' => true,
            'options' => [
                'label' => 'Date de fin de la formation',
            ],
            'attributes' => [
                'id'  => "dateFin",
                'placeholder' => "31/01/2021",
                'class' => "form-control",
                'data-rule' => 'date',
                'data-msg' => 'Veuillez renseignez la date de fin'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'lieu',
            'required' => true,
            'options' => [
                'label' => 'Lieu',
            ],
            'attributes' => [
                'id'  => "lieu",
                'placeholder' => "Abidjan",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le lieu'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Select::class,
            'name' => 'typeFormationId',
            'required' => true,
            'options' => [
                'label' => 'Type de formation',
            ],
            'attributes' => [
                'id'  => "typeFormationId",
                'placeholder' => "Message",
                'class' => "form-control",
                'data-rule' => 'required',
                'data-msg' => 'Veuillez renseignez le type de formation'
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
                'value' => 'Enregistrer la formation'
            ],
        ]);
        
    }
    
    public function getInputFilter(){
        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'name' => 'libelle',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'dateDebut',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'dateFin',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'lieu',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'lieu',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);


        return $inputFilter;

    }
    
}
