<head>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
		?>
</head>
<div id="menu">
<table>
<tr>
<td><?php echo $this->Html->link('Clientes', array('controller' => 'users', 'action' => 'sesion',1)); ?>
</td>	
<td><?php echo $this->Html->link('Empresas', array('controller' => 'users', 'action' => 'sesion',2)); ?>
</td>
<td><?php echo $this->Html->link('Reportes', array('controller' => 'empresas', 'action' => 'reportes')); ?>
</td>
<td><?php echo $this->Html->link('Pagos', array('controller' => 'abonos', 'action' => 'elegir_empresa')); ?>
</td>
<td><?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>
</td>
</tr>
</table>
</div>

<fieldset>
	<legend>Ir a Fecha:</legend>
<?php echo $this->Form->create('Incidencia',array('controller'=>'incidencias', 'action'=>'estado', $id)); ?>
<?php echo $this->Form->input('fecha_inicio', array(
									'class' => 'calendar'
								 )); ?>
<?php echo $this->Form->input('fecha_final', array(
								 'class' => 'calendar'
								 )); ?>
<?php echo $this->Form->input('id',array('type' => 'hidden', 'value' => $id)); ?>				
<?php echo $this->Form->end('Ir a fecha'); ?>
</fieldset>
<h2>Estado de cuenta</h2>
<table>
	<tr>
		<th>#</th>
		<th>Nombre:</th>
		<th>Pagos Actual:</th>
		<th>Cantidad Pagada:</th>
		<th>Debe:</th>
		<th>Pagos Realizados:</th>
	</tr>
	<?php
		$i = 1;
		$total_pagado = 0;
		$total_debe = 0;
		foreach($informacion as $cliente => $datos):
			$total_debe = $total_debe + $datos['debe'];
			$total_pagado = $total_pagado + $datos['cantidad_pagada'];
			$pago_actual = explode('/', $datos['pago_actual']);	?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $cliente;?></td>
			<td><?php echo $datos['pago_actual'];?></td>
			<td><?php echo '$'.number_format($datos['cantidad_pagada'],2);?></td>
			<td><?php echo '$'.number_format($datos['debe'],2);?></td>
			<td><?php echo $this->Html->link('Pagos', array('controller' => 'pagos', 'action' => 'pagos_realizados', $datos['id'], '?' => array('pago_actual' => $pago_actual[0])));?></td>
		</tr>
	<?php endforeach;?>
		<tr>
			
			<td><?php echo 'Total: ' ?></td>
			<td> </td>
			<td> </td>
			<td><?php echo '$'.number_format($total_pagado, 2);?></td>
			<td><?php echo '$'.number_format($total_debe, 2);?></td>
		</tr>
	
</table>