<?php

class User extends AppModel{
	var $name='User';
	
	var $actAs = array(
		'Containable'
	);
	
	var $hasMany= array('Empresa' => array(
		'className' => 'Empresa',
		'foreignKey' => 'user_id',
		'dependent'=> true
	));
	
	var $validate= array(	
		'name'=>array(
			'regla1'=>array(
				'rule'=>'isUnique',
				'message'=>'El nombre de usuario que eligió no esta disponible'
			),
			'regla2'=>array(
				'rule'=>'notEmpty',
				'message'=>'Este campo no puede dejarse en blanco'
			)),
			
		'password'=>array(
				'rule'=>array('minLength',8),
				'message'=>'La contraseña debe tener entre 8 y 10 caracteres de largo'
		),
		'nombre'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'apellido'=>array(
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
		'curp'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'rfc'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'),
		'permisos'=>array(
			'rule'=>'notEmpty',
			'message'=>'Este campo no puede dejarse en blanco'));
			
} 
?>