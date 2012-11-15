<?php

class Abono extends AppModel{
	var $name='Abono';
	
	var $actAs = array('Containable');
	
	var $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id'
		),
		'Cobro' => array(
			'className' => 'Cobro',
			'foreignKey' => 'cobro_id'
		)
	);
	
	var $hasMany = array(
		'Asociation' => array(
			'className' => 'Asociation',
			'foreign_key' => 'abono_id',
			'dependent' => true
		)
	);
	
	
}
?>
