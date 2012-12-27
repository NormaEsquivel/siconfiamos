<?php

class Credito extends AppModel{
		
		var $name='Credito';
		var $actAs = array('Containable');
		
		var $belongsTo=array(
			'Cliente'=>array(
				'className' => 'Cliente',
				'foreingKey'=>'cliente_id'
			)
		);
		 var $hasMany=array(
		 	'Pago'=>array(
				'className'=>'Pago',
				'foreignKey'=>'credito_id',
				'dependent'=>true
			)
		);
		var $validate=array(
			'fecha'=>array(
				'rule'=> 'notEmpty',
				'message'=>'Introduzca una fecha válida'),
			'cheque'=>array(
				'rule2'=>array(
					'rule'=>'notEmpty',
					'message'=>'Este campo no puede estar vacío')),
			'prestamo'=>array(
				'rule'=>'numeric',
				'message'=>'Introduzca un valor numérico'),
			'fecha_calculo'=>array(
				'rule'=> 'notEmpty',
				'message'=>'Introduzca una fecha válida'),
			'tipo_calculo'=>array(
				'rule'=>'notEmpty',
				'message'=>'Este campo no puede estar en blanco'),
			'periodo_cuotas'=>array(
				'rule'=>'notEmpty',
				'message'=>'Este campo no puede estar en blanco'),
			'valor_cuotas'=>array(
				'rule'=>'numeric',
				'message'=>'Introduzca un valor numérico'),
			'tasa_interes'=>array(
				'rule'=>'numeric',
				'message'=>'Introduzca un valor numérico'),
			'cuotas'=>array(
				'rule'=>'numeric',
				'message'=>'Introduzca un valor numérico')
			);
			
}
?>
