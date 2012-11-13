<?php


class Pago extends AppModel{
	var $name='Pago';
	
	
	var $virtualFields = array(
	    'fecha_bien' => "STR_TO_DATE(Pago.fecha, '%d-%m-%Y')"
	);
	
	var $actAs = array(
		'Containable'
	);
	// var $hasMany = array(
		// 'Abono' => array(
			// 'className' => 'Abono',
			// 'foreignKey' => 'pago_id',
			// 'dependent' => true
		// )
	// );
	var $hasMany = array(
		'Asociation' => array(
			'className' => 'Asociation',
			'foreignKey' => 'pago_id',
			'dependent'=> true
		)
	);
	
	var $belongsTo = array(
		'Credito' => array(
			'className' => 'Credito',
			'foreignKey' => 'credito_id'
		)
	);
}
	
