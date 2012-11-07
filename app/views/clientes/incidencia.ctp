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
<?php echo $this->Form->create('Cliente',array('controller'=>'clientes', 'action'=>'incidencia', $id)); ?>
<?php echo $this->Form->input('fecha_inicio', array(
									'class' => 'calendar'
								 )); ?>
<?php echo $this->Form->input('fecha_final', array(
								 'class' => 'calendar'
								 )); ?>
<?php echo $this->Form->input('periodo',array(
								 'type'=>'select',
								 'options'=>array('semanal'=>'Semanal','quincenal'=>'Quincenal','mensual'=>'Mensual'))); ?>
<?php echo $this->Form->input('id',array('type' => 'hidden', 'value' => $id)); ?>				
<?php echo $this->Form->end('Ir a fecha'); ?>
</fieldset>
<?php echo $this->Html->link('Imprimir Incidencia',array('controller'=>'incidencias','action'=>'imprimir')); ?>
<br>
<br>
<h3>Incidencia de la empresa <?php echo $total['nombre_empresa'] ?></h3>
<table>
<tr>
	<th>#</th>
	<th>No. Cheque</th>
	<th>Nombre Cliente</th>
	<th>Fecha de emisión</th>
	<th># Pago</th>
	<th>Retención</th>
	<th>Capital</th>
	<th>Interés</th>
	<th>IVA</th>
	<th>Saldo Pago</th>
	<th>Situación</th>
</tr>
<?php 
echo $this->Form->create('Pago',array('controller'=>'pagos','action'=>'pagos_incidencia'));
$cuenta=1;
foreach($pagos as $key => $arreglo):
	foreach($arreglo as $pago):?>
	<tr>
		<td><?php echo $cuenta; ?></td>
		<td><?php echo $pago['Credito']['cheque']; ?></td>
		<td><?php echo isset($clientes[$key]['Cliente']['division']) ? $clientes[$key]['Cliente']['full_name'].' (' . $clientes[$key]['Cliente']['division'] . ')' : $clientes[$key]['Cliente']['full_name']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($pago['Pago']['fecha'])); ?></td>
		<td><?php echo $pago['Pago']['numero_pago'] ?></td>
		<td>$ <?php echo number_format($pago['Pago']['pago'],2); ?></td>
		<td>$ <?php echo number_format($pago['Pago']['pago_capital'],2); ?></td>
		<td>$ <?php echo number_format($pago['Pago']['intereses'],2); ?></td>
		<td>$ <?php echo number_format($pago['Pago']['iva_intereses'],2); ?></td>
		<td><?php echo $pago['Pago']['saldo_pago'] != null ? '$' . number_format($pago['Pago']['saldo_pago'], 2) :''?></td>
		<td><?php echo $pago['Pago']['sitacion']; ?></td>
	</tr>
	<?php endforeach; ?>
<?php endforeach; ?>
<tr>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td>Total:</td>
	<td>$ <?php echo number_format($total['Pago'],2); ?></td>
	<td>$ <?php echo number_format($total['Capital'],2); ?></td>
	<td>$ <?php echo number_format($total['Interes'],2); ?></td>
	<td>$ <?php echo number_format($total['Iva'],2); ?></td>
	
</tr>
</table>

<br>
<?php echo $this->Form->end('Pagar');?>