<?php namespace Application\Form;
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
class ContactFormForm extends Form {
    
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
                'id'  => "nom",
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
                'id'  => "email",
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
                'id'  => "sujet",
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
                'id'  => "message",
                'placeholder' => "Message",
                'class' => "form-control",
                'rows' => 5,
                'data-rule' => 'required',
                'data-msg' => 'Veuillez remplir le champs'
            ]
        ]);
        $this->add([
            'type'  => 'submit',
            'name' => 'envoyer',
            'attributes' => [   
                'class'  => 'btn btn-danger py-3 px-5',       
                'value' => 'Envoyer'
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
