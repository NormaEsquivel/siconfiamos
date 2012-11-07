<head>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/creditos/js/add');
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
<td><?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>
</td>
</tr>
</table>
</div>
<br>
<?php echo $this->Html->link('Historial de Crédito',array('action'=>'historial',$id)); ?>
<br>
<br>
<fieldset>
<legend>Nuevo Crédito</legend>
<?php

echo $this->Form->create('Credito',array('action'=>'add')); ?>
<table>
<tr>
	<td><?php echo $this->Form->input('fecha', array(
								 'type'=>'text',
								 'label' => 'Fecha:', 
								 'id'=>'calendario')); ?></td>
	<td> </td>
	<td><?php echo $this->Form->input('cheque',array('label'=>'Número de Cheque:')); ?></td>
	
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
	<td><?php echo $this->Form->input('fecha_calculo', array(
								 'class' => 'calendar',
								 'type' => 'text',
								 'label' => 'Fecha de cálculo' 
								));
		?></td>
	<td><?php echo $this->Form->input('tipo_calculo',array(
										'type'=>'select',
										'empty' => '(Seleccione un cálculo)',
										'options' => array('capital'=>'Capital Fijo','insoluto'=>'Saldos Insolutos'),
										'label' => 'Tipo de cálculo'));  ?></td>
	<td class = "tasa_interes"></td>
</tr>
</table>
<?php echo $this->Form->end('Calcular');?>
</fieldset>