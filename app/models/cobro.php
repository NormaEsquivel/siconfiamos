<?php

class Cobro extends AppModel{
	var $name  = 'Cobro';
	
	var $actAs = array('Containable');
	
	var $hasMany = array(
		'Abono' => array(
			'className' => 'Abono',
			'foreign_key' => 'cobro_id',
			'dependent' => true
		)
	);
	
	var $belongsTo = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreign_key' =>'empresa_id'
		)
	);
	
}


?>