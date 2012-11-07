<head>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
			echo $this->Html->script('src/views/creditos/cotizar');
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
<br>
<h2>Cotización</h2>
<?php

echo $this->Form->create('Credito',array('action'=>'cotizar')); ?>
<table>
<tr>
	<td colspan="2"><?php echo $this->Form->input('nombre_cliente',array('label'=>'Cliente:')); ?></td>
	
</tr>
<tr>
	<td><?php echo $this->Form->input('cuotas',array('label'=>'Cuotas (meses):')); ?></td>
	<td><?php echo $this->Form->input('periodo_cuotas', array(
								'type'=>'select',
								'options'=>array('diario'=>'Diario','semanal'=>'Semanal','quincenal'=>'Quincenal','mensual'=>'Mensual','anual'=>'Anual'),
								'label'=>'Periodo de pago:'
								)); ?></td>
	<td><?php echo $this->Form->input('prestamo',array('label'=>'Préstamo:')); ?></td>
	
</tr>
<tr>
	<td><?php echo $this->Form->input('fecha_cotizacion', array(
								 'class' => 'calendar',
								 'label' => 'Fecha de cálculo', 
								)); ?></td>
	<td><?php echo $this->Form->input('tipo_calculo',array(
										'type'=>'select',
										'empty' => '(Seleccione un cálculo)',
										'options' => array('capital'=>'Capital Fijo','insoluto'=>'Saldos Insolutos'),
										'label' => 'Tipo de cálculo'));  ?></td>
	<td class = "tasa_interes"></td>
</tr>
</table>
<?php echo $this->Form->end('Calcular');?>