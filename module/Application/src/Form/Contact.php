<?php namespace Application\Form;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;

/**
 * Description of Contact
 *
 * @author kjkoffi
 */
class Contact extends Form {
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setAttribute('enctype', 'multipart/form-data');
        // data-rule="minlen:4" data-msg="Veuillez remplir le champs!"
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'nom',
            'required' => true,
            'options' => [
                'label' => 'Votre nom',
            ],
            'attributes' => [
                'placeholder' => "Votre nom",
                'class' => "form-control",
                'data-rule' => 'minlen:4',
                'data-msg' => 'Veuillez remplir le champs'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Email::class,
            'name' => 'email',
            'required' => true,
            'options' => [
                'label' => 'Votre Mail',
            ],
            'attributes' => [
                'placeholder' => "Votre Mail",
                'class' => "form-control",
                'data-rule' => 'email',
                'data-msg' => 'Veuillez remplir le champs'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Text::class,
            'name' => 'sujet',
            'required' => true,
            'options' => [
                'label' => 'Sujet',
            ],
            'attributes' => [
                'placeholder' => "Sujet",
                'class' => "form-control",
                'data-rule' => 'minlen:4',
                'data-msg' => 'Veuillez remplir le champs'
            ]
        ]);
        
        $this->add([
            'type'  => Element\Textarea::class,
            'name' => 'message',
            'required' => true,
            'options' => [
                'label' => 'Message',
            ],
            'attributes' => [
                'placeholder' => "Message",
                'class' => "form-control",
                'rows' => 5,
                'data-rule' => 'required',
                'data-msg' => 'Veuillez remplir le champs'
            ]
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
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'sujet',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'message',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
        
        return $inputFilter;
    }
    
}
