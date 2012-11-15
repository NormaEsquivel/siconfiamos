<?php

class Asociation extends AppModel{
	
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Pago' => array(
			'className' => 'Pago',
			'foreignKey' => 'pago_id'
		),
		'Abono' => array(
			'className' => 'Abono',
			'foreignKey' => 'abono_id'
		)
	);
}
?>
