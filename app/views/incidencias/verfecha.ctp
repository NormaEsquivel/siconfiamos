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
<h3>Incidencias de <?php echo $nombre_empresa ?> Semana <?php echo date('W')?> con fecha de cobro: <?php echo $viernes?></h3>
<br>
<fieldset>
	<legend>Ir a Fecha:</legend>
<?php echo $this->Form->create('Incidencia',array('controller'=>'incidencias','action'=>'verfecha')); ?>
<?php echo $this->Form->input('fecha_incidencia', array(
								 'type'=>'date',
								 'label' => 'Fecha de incidencia', 
								 'dateFormat' => 'DMY', 'minYear' => date('Y')-5, 'maxYear' => date('Y')+10)); ?>
<?php echo $this->Form->end('Ir a fecha'); ?>
</fieldset>
<br>
<?php echo $this->Html->link('Imprimir Incidencia',array('action'=>'imprimir')); ?>
<br>
<table>
<tr><th>No. Cheque</th>
	<th>Nombre Cliente</th>
	<th>Fecha de emisión</th>
	<th>Número de pago</th>
	<th>Retención</th>
	<th>Capital</th>
	<th>Interés</th>
	<th>IVA</th>
	<th>Situación</th>
	<th>Pagar</th>
</tr>
<?php 
echo $this->Form->create('Pago',array('controller'=>'pagos','action'=>'pagos_incidencia'));
$cuenta=1;
foreach($pagos as $pago):?>
	<tr>
		<td><?php echo $pago['cheque']; ?></td>
		<td><?php echo $pago['nombre']; ?></td>
		<td><?php echo $pago['fecha']; ?></td>
		<td><?php echo $pago['numero_pago'] ?></td>
		<td>$ <?php echo number_format($pago['pago'],2); ?></td>
		<td>$ <?php echo number_format($pago['pago_capital'],2); ?></td>
		<td>$ <?php echo number_format($pago['intereses'],2); ?></td>
		<td>$ <?php echo number_format($pago['iva'],2); ?></td>
		<td><?php echo $pago['sitacion']; ?></td>
		<td><?php echo $this->Form->checkbox($cuenta, array('value' => 1)); 
			$cuenta++;?></td>
	</tr>
<?php endforeach; ?>
<tr> <td> </td>
	<td> </td>
	<td> </td>
	<td>Total:</td>
	<td>$ <?php echo number_format($total,2); ?></td>
	<td>$ <?php echo number_format($totalcapital,2); ?></td>
	<td>$ <?php echo number_format($totalinteres,2); ?></td>
	<td>$ <?php echo number_format($totaliva,2); ?></td>
	
</tr>
</table>

<br>
<?php echo $this->Form->end('Pagar');?>
<br>
