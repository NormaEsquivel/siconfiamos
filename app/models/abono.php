<?php

class Abono extends AppModel{
	var $name='Abono';
	
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
		'Pago' => array(
			'className' => 'Pago',
			'foreign_key' => 'abono_id',
			'dependent' => true
		)
	);
	
	
}
?>
