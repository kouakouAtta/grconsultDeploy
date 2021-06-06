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
class ClientForm extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        
        $this->add([
            'type'  => 'file',
            'name' => 'image',
            'required' => false,
            'options' => [
                'label' => 'Image du logo',
            ],
            'attributes' => [
                'id'  => "titre",
                'placeholder' => "selectionnez l\'image",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez l\'image'
            ]
        ]);

        $this->add([
            'type'  => Element\Text::class,
            'name' => 'nom',
            'required' => true,
            'options' => [
                'label' => 'Nom du client / partenaires',
            ],
            'attributes' => [
                'id'  => "sousTitre",
                'placeholder' => "inscrivez le nom du client / partenaires",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez le nom du client / partenaires'
            ]
        ]);


        $this->add([
            'type'  => Element\Text::class,
            'name' => 'abrege',
            'required' => true,
            'options' => [
                'label' => 'Abregé',
            ],
            'attributes' => [
                'id'  => "text",
                'placeholder' => "SGBCI",
                'class' => "form-control",
                'data-rule' => 'minlen:1',
                'data-msg' => 'Veuillez renseignez l\abregé'
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
            'name' => 'nom',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        $inputFilter->add([
            'type'     => 'Laminas\InputFilter\FileInput',
            'name'     => 'image',
            'required' => false,   
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
                        'target' => './public/data/documents/pieces',
                        'useUploadName' => true,
                        'useUploadExtension' => true,
                        'overwrite' => true,
                        'randomize' => false
                    ]
                ]
            ],   
        ]);
        $inputFilter->add([
            'name' => 'abrege',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);


        return $inputFilter;

    }
    
}
