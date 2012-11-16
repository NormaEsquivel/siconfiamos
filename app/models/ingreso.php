<?php

class Ingreso extends AppModel{
	var $name='Ingreso';
	var $actsAs = array('Containable');
	var $belongsTo=array('Cliente'=> array(
		'className' => 'Cliente',
		'foreignKey' => 'cliente_id'));

}
?>
