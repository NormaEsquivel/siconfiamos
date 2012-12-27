<?php

class Personal extends AppModel{
	var $name='Personal';
	
	var $actsAs = array('Containable');
	
	var $belongsTo=array(
		'Cliente'=> array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id'
		)
	);
	
	var $validate=array(
		'nombre'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		),
		'lugar_trabajo'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		),
		'direccion'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		),
		'colonia'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		),
		'estado'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		),
		'codigo_postal'=>array(
			'rule'=>'numeric',
			'message'=>'Este campo sólamente puede contener números'
		),
		'localidad'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede estar vacío'
		)
	);
}

?>