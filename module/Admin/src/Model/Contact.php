<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Description of Contact *
 * @author kjkoffi
 */

class Contact implements InputFilterAwareInterface{
    protected $inputFilter;
    
    public $id;
    public $contactLocalisatonAdresse;
    public $telephone;
    public $horaire;
    public $email;
    public $dateCreation;
    public $dateModification;

    public function exchangeArray($data){
        $this->id = !empty($data['id']) ? $data['id'] : null;
		$this->contactLocalisatonAdresse = !empty($data['contactLocalisatonAdresse']) ? $data['contactLocalisatonAdresse'] : null;
        $this->telephone = !empty($data['telephone']) ? $data['telephone'] : null;
        $this->horaire = !empty($data['horaire']) ? $data['horaire'] : null;
		$this->email = !empty($data['email']) ? $data['email'] : null;
        $this->dateCreation = !empty($data['dateCreation']) ? $data['dateCreation'] : null;
        $this->dateModification = !empty($data['dateModification']) ? $data['dateModification'] : null;
    }

    public function getArrayCopy(){
        return [
            'id' => $this->id,
			'contactLocalisatonAdresse' => $this->contactLocalisatonAdresse,
            'telephone' => $this->telephone,
			'horaire' => $this->horaire,
            'email' => $this->email,
            'dateCreation' => $this->dateCreation,
            'dateModification' => $this->dateModification,
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();
            
            $inputFilter->add($factory->createInput([
			'name'       => 'id',
			'required'   => true,
                            'filters' => [
                                ['name'    => 'Int'],
                            ],
			]));
			            $inputFilter->add($factory->createInput([
			'name'     => 'contactLocalisatonAdresse',
			'required' => true,
			'filters'  => [
                            ['name' => 'StripTags'],
                            ['name' => 'StringTrim'],
			],
			'validators' => [
			[
			'name'    => 'StringLength',
			'options' => [
			'encoding' => 'utf-8',
			'min'      => 1,
			'max'      => 124,
				],
				],
				],
				]));
				            $inputFilter->add($factory->createInput([
			'name'     => 'telephone',
			'required' => true,
			'filters'  => [
                            ['name' => 'StripTags'],
                            ['name' => 'StringTrim'],
			],
			'validators' => [
			[
			'name'    => 'StringLength',
			'options' => [
			'encoding' => 'utf-8',
			'min'      => 1,
			'max'      => 124,
				],
				],
				],
				]));
				            $inputFilter->add($factory->createInput([
			
			'name'     => 'horaire',
			'required' => true,
			'filters'  => [
                            ['name' => 'StripTags'],
                            ['name' => 'StringTrim'],
			],
			'validators' => [
			[
			'name'    => 'StringLength',
			'options' => [
			'encoding' => 'utf-8',
			'min'      => 1,
			'max'      => 124,
				],
				],
				],
				]));
				            $inputFilter->add($factory->createInput([
			'name'     => 'email',
			'required' => true,
			'filters'  => [
                            ['name' => 'StripTags'],
                            ['name' => 'StringTrim'],
			],
				]));
				           			            	         			 
            $this->inputFilter = $inputFilter;        
        }

        return $this->inputFilter;
    }
}