<?php

class Personal extends AppModel{
	var $name='Personal';
	
	var $belongsTo=array('Cliente'=> array(
		'className' => 'Cliente',
		'foreignKey' => 'cliente_id'
	
	));
	var $validate=array(
		'nombre'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'),
		'lugar_trabajo'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'),
		'direccion'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'),
		'colonia'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'),
		'estado'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'),
		'codigo_postal'=>array(
			'rule'=>'numeric',
			'message'=>'Este campo sólamente puede contener números'),
		'telefono'=>array(
			'rule1'=>array(
				'rule'=>'numeric',
				'message'=>'Sólamente puede introducir números'),
			'rule2'=>array(
				'rule'=>array('between',10,10),
				'message'=>'Introduzca 10 dígitos para el télefono')),
		'localidad'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'));
}

?>