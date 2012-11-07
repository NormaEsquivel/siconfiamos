<?php

class Incidencia extends AppModel{
	var $name='Incidencia';
	var $belongsTo=array('Empresa'=>array(
							'className'=>'Empresa',
							'foreignKey'=>'empresa_id'));	
}
