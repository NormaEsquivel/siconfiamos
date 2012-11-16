<?php

class Empresa extends AppModel{
	var $name='Empresa';
	
	var $actsAs = array('Containable');
	
	var $hasMany= array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'empresa_id',
			'dependent'=> true
		)
	);
	
	var $belongsTo=array('User'=> array(
		'className' => 'User',
		'foreignKey' => 'user_id'
	
	));
	
	var $validate=array(
		'nombre'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'representante'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'direccion'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'telefono'=>array(
			'rule1'=>array(
				'rule'=>'numeric',
				'message'=>'Sólamente puede introducir números'),
			'rule2'=>array(
				'rule'=>array('between',10,10),
				'message'=>'Introduzca 10 dígitos para el télefono')),
		'codigo_postal'=>array(
			'rule1'=>array(
				'rule'=>'numeric',
				'message'=>'Sólamente puede introducir números'),
			'rule2'=>array(
				'rule'=>'notEmpty',
				'message'=>'Esta campo no puede dejarse en blanco')),
		'ciudad'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'estado'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'rfc'=>array(
			'rule'=>'alphaNumeric',
			'message'=>'Solamente puede introducir números y letras'));
}

?>