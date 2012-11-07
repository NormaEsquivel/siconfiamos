<?php

class Cliente extends AppModel{
	var $name='Cliente';
	
	var $actAs = array(
		'Containable'
	);
	
	var $virtualFields = array(
	    'full_name' => 'CONCAT_WS(" ", Cliente.nombre, Cliente.apellido_paterno, Cliente.apellido_materno)'
	);
	
	var $hasMany= array(
		'Aval' => array(
		'className' => 'Aval',
		'foreignKey' => 'cliente_id',
		'dependent'=> true),
		'Ingreso'=>array(
		'className'=>'Ingreso',
		'foreignKey'=>'cliente_id',
		'dependent'=>true),
		'Familiar'=>array(
		'className'=>'Familiar',
		'foreignKey'=>'cliente_id',
		'dependent'=>true),
		'Personal'=>array(
		'className'=>'Personal',
		'foreignKey'=>'cliente_id',
		'dependent'=>true),
		'Credito'=>array(
		'className'=>'Credito',
		'foreignKey'=>'cliente_id',
		'dependent'=>true)
	);
	
	var $belongsTo=array('Empresa'=> array(
		'className' => 'Empresa',
		'foreignKey' => 'empresa_id'
	
	));
	
	var $validate=array(
		'nombre'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'apellido_paterno'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'apellido_materno'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'direccion'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'colonia'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'localidad'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'estado'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco'),
		'codigo_postal'=>array(
			'rule1'=>array(
				'rule'=>'notEmpty',
				'message'=>'Este campo no se puede dejar en blanco'),
			'rule2'=>array(
				'rule'=>'numeric',
				'message'=>'Este campo sólo puede contener números')),
		'telefono_1'=>array(
			'rule1'=>array(
				'rule'=>'numeric',
				'message'=>'Sólamente puede introducir números'),
			'rule2'=>array(
				'rule'=>array('between',10,10),
				'message'=>'Introduzca 10 dígitos para el télefono')),
		'telefono_2'=>array(
			'rule1'=>array(
				'rule'=>'numeric',
				'message'=>'Sólamente puede introducir números'),
			'rule2'=>array(
				'rule'=>array('between',10,10),
				'message'=>'Introduzca 10 dígitos para el télefono')),		
		'rfc'=>array(
			'rule'=>'alphaNumeric',
			'message'=>'Solamente puede introducir números y letras'),
		'identificacion'=>array(
			'rule'=>'numeric',
			'message'=>'Solamente puede poner números en este campo'),
		'fecha_nacimiento'=>array(
			'rule'=>array('date','ymd'),
			'message'=>'Introduzca una fecha válida'),
		'curp'=>array(
			'rule'=>'alphaNumeric',
			'message'=>'Solamente puede introducir números y letras'),
		'dependientes'=>array(
			'rule'=>'numeric',
			'message'=>'Este campo solamente puede contener números'),
		'antiguedad_laboral'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no se puede dejar en blanco')
			);
		
}

?>