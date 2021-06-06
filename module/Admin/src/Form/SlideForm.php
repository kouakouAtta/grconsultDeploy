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
class SlideForm extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        //$this->setAttribute('enctype', 'multipart/form-data');
        $this->add([
            'type'  => 'file',
            'name' => 'image',            
            'options' => [
                'label' => 'Image du slide',
            ],
            'attributes' => [                
                'multiple' => false
            ]
        ]);
        
        $this->add([
            'type'  => Element\text::class,
            'name' => 'titre',
            'required' => true,
            'options' => [
                'label' => 'titre du slide',
            ],
            'attributes' => [
                'id'  => "titre",
                'placeholder' => "MUTUALITE",
                'class' => "form-control",
                'data-rule' => 'text',
                'data-msg' => 'Veuillez renseignez le titre'
            ]
        ]);

        $this->add([
            'type'  => Element\text::class,
            'name' => 'libelle',
            'required' => true,
            'options' => [
                'label' => 'libelle du slide',
            ],
            'attributes' => [
                'id'  => "libelle",
                'placeholder' => "Le relationnel au coeur du développment",
                'class' => "form-control",
                'data-rule' => 'text',
                'data-msg' => 'Veuillez renseignez le libelle'
            ]
        ]);

        $this->add([
            'type'  => Element\text::class,
            'name' => 'libelleBtn',
            'required' => true,
            'options' => [
                'label' => 'libelle du bouton du slide',
            ],
            'attributes' => [
                'id'  => "libelleBtn",
                'placeholder' => "Nos services",
                'class' => "form-control",
                'data-rule' => 'text',
                'data-msg' => 'Veuillez renseignez le libelle du bouton de renvoie'
            ]
        ]);
        

        $this->add([
            'type'  => Element\text::class,
            'name' => 'routeBtn',
            'required' => false,
            'options' => [
                'label' => 'route vers laquelle me le bouton du slide',
            ],
            'attributes' => [
                'id'  => "routeBtn",
                'placeholder' => "prestations-service",
                'class' => "form-control",
                'data-rule' => 'text',
                'data-msg' => 'Veuillez renseignez la route'
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
                'value' => 'Enregistrer le slide'
            ],
        ]);
        
    }
    
    public function getInputFilter(){
        $inputFilter = new InputFilter();
        
        $inputFilter->add([
            'type'     => 'Laminas\InputFilter\FileInput',
            'name'     => 'image',
            'required' => true,   
            'validators' => [
                
                [
                    'name'    => 'FileMimeType',                        
                    'options' => [                            
                        'mimeType'  => ['image/jpeg','image/jpg', 'image/png']
                    ]
                ],
                //['name'    => 'FileIsImage'],
                [
                    'name'    => 'FileSize',
                    'options' => [
                        'minWidth'  => 128,
                        'minHeight' => 128,
                        'maxWidth'  => 4096,
                        'maxHeight' => 4096]
                ],
            ],
            'filters'  => [                    
                [
                    'name' => 'FileRenameUpload',
                    'options' => [  
                        //'target' => './data/documents/pieces', à décommenter en local
                        'target' => './data/documents/slides',
                        'useUploadName' => true,
                        'useUploadExtension' => true,
                        'overwrite' => true,
                        'randomize' => false
                    ]
                ]
            ],   
        ]);
        
        $inputFilter->add([
            'name' => 'titre',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'libelle',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'libelleBtn',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'routeBtn',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);


        return $inputFilter;

    }
    
}
