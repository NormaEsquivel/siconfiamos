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
<?php
App::import('Vendor', 'format');
$format = new format();
?>
<fieldset>
	<legend>Empresa</legend>
	<?php echo $this->Form->create('Empresa', array('controller' => 'empresas', 'action' => 'pagosatrasados')); ?>
		<?php echo $this->Form->input('empresa_id', array(
			'type' => 'select',
			'options' => $opciones
		)); ?>
	<?php echo  $this->Form->end('Buscar'); ?>
</fieldset>
<h2>Pagos Atrasados de <?php echo $empresa['Empresa']['nombre']; ?></h2>
<br>
<table>
	<tr>
		<th>Cliente</th>
		<th>Numero de pago</th>
		<th>Fecha de pago</th>
		<th>Monto del pago</th>
		<th>Saldo</th>
	</tr>
	<?php foreach($atrasado as $cliente => $pagos): ?>
		<tr>	
			<td><?php echo $cliente; ?></td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
		<?php foreach($pagos as $pago): ?>
			<tr>
				<td> </td>
				<td><?php echo $pago['numero_pago']; ?></td>
				<td><?php echo $format->fechapago($pago['fecha']); ?></td>
				<td>$<?php echo number_format($pago['pago'], 2); ?></td>
				<td>$<?php echo number_format($atrasado[$cliente][0]['saldo'],2); ?> </td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
</table>
<br>
<?php echo $this->Html->link($this->Html->image('icon_excel.png'), array('controller' => 'empresas', 'action' => 'exportar_atrasados'), array('escape' => false, 'title' =>'Exportar')); ?>
