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
class ConditionForm extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'montant',
            'required' => true,
            'options' => [
                'label' => 'Montant total de participation(Fcfa)',
            ],
            'attributes' => [
                'id'  => "montant",
                'placeholder' => "50000",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le montant de la formation'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'remise',
            'required' => false,
            'options' => [
                'label' => 'remise(%)',
            ],
            'attributes' => [
                'id'  => "Rémise",
                'placeholder' => "10",
                'class' => "form-control",
                'data-rule' => 'date',
                'data-msg' => 'Veuillez renseignez la remise'
            ]
        ]);

        $this->add([
            'type'  => Element\Select::class,
            'name' => 'niveau',
            'required' => true,
            'options' => [
                'label' => 'Niveau minimum requis',
            ],
            'attributes' => [
                'id'  => "	niveau",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le niveau'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Select::class,
            'name' => 'specialite',
            'required' => true,
            'options' => [
                'label' => 'Selectionnez les spécialités',
            ],
            'attributes' => [
                'id'  => "specialite",
                'placeholder' => "Informatique",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez la/les spécialités'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Date::class,
            'name' => 'date',
            'required' => true,
            'options' => [
                'label' => 'Date d\'échéance des inscriptions à la formation',
            ],
            'attributes' => [
                'id'  => "date",
                'placeholder' => "Message",
                'class' => "form-control",
                'data-rule' => 'required',
                'data-msg' => 'Veuillez renseignez la date'
            ]
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'annuler',
            'attributes' => [
                'class'  => 'btn btn-sm btn-warning',       
                'value' => 'Annuler'
            ],
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'enregistrer',
            'attributes' => [   
                'class'  => 'btn btn-sm btn-success',       
                'value' => 'Enregistrer les conditions'
            ],
        ]);
        
    }
    
    public function getInputFilter(){
        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'name' => 'montant',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'remise',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'niveau',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'specialite',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'date',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);


        return $inputFilter;

    }
    
}
