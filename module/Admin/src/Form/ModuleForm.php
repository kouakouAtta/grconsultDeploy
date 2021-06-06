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
class ModuleForm extends Form {
    
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
                'label' => 'Libellé du module',
            ],
            'attributes' => [
                'id'  => "libelle",
                'placeholder' => "Module 1 : Rappel",
                'class' => "form-control",
                'data-rule' => 'minlen:4',
                'data-msg' => 'Veuillez renseignez le libellé du module'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Textarea::class,
            'name' => 'contenu',
            'required' => true,
            'options' => [
                'label' => 'Contenu du module',
            ],
            'attributes' => [
                'id'  => "contenu",
                'placeholder' => "Chapitre 1 : Mot de bienvenue",
                'class' => "form-control",
                'rows' => 5,
                'data-rule' => 'required',
                'data-msg' => 'Veuillez renseignez la date de début'
            ]
        ]);

        $this->add([
            'type'  => Element\Text::class,
            'name' => 'cout',
            'required' => true,
            'options' => [
                'label' => 'Cout du module',
            ],
            'attributes' => [
                'id'  => "cout",
                'placeholder' => "30000",
                'class' => "form-control",
                'data-rule' => 'date',
                'data-msg' => 'Veuillez renseignez la date de fin'
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
                'value' => 'Enregistrer le module'
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
            'name' => 'contenu',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'cout',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        return $inputFilter;

    }
    
}
