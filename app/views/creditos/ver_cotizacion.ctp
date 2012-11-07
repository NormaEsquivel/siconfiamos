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
</div><?php 
App::import('Vendor', 'format');
$format = new format(); ;?>
<h2>COTIZACIÓN DE CRÉDITO</h2>
<table>	
<tr>
	<th>Nombre del Cliente:</th><td><?php echo $credito['Credito']['nombre_cliente'];?></td></tr>
	<tr></tr><th>Tasa de Interés:</th><td><?php echo $credito['Credito']['tasa_interes']; ?></td></tr>
	<tr><th>Número de cuotas:</th><td><?php echo $credito['Credito']['cuotas'];; ?></td></tr>
	<tr><th>Periodo de cuotas:</th><td><?php echo $credito['Credito']['periodo_cuotas']; ?></td></tr>
	

	<tr><th>Préstamo:</th><td><?php echo $credito['Credito']['prestamo']; ?></td></tr>
	<tr><th>Fecha de cálculo:</TH><td><?php echo $format->fechacalendario($credito['Credito']['fecha_cotizacion']) ?></td></TR>
	<tr><th>Tipo de cálculo:</TH><td><?php echo $credito['Credito']['tipo_calculo'];  ?></td></tr>
</table>
<br>
<?php echo $this->Html->link('Imprimir', array('action' => 'pdfcotizar')); ?>
<br>
<br>
<br>
<h3>Pagos</h3>
<table>
	<tr>
		<th>Fecha:</Th>
		<th>Numero de pago:</th>
		<th>Pago de capital:</Th>
		<th>Intereses:</Th>
		<th>IVA:</Th>
		<th>Pago:</Th>
		<th>Saldo Insoluto:</Th>
	</tr>
	<?php foreach($arreglo['Pago'] as $pago): ?>
		<tr>
			<td><?php echo $pago['fecha']; ?></td>
			<td><?php echo $pago['numero_pago']; ?></td>
			<td><?php echo '$'.number_format($pago['pago_capital'],2); ?></td>
			<td><?php echo '$'.number_format($pago['intereses'],2); ?></td>
			<td><?php echo '$'.number_format($pago['iva_intereses'],2); ?></td>
			<td><?php echo '$'.number_format($pago['pago'],2); ?></td>
			<td><?php echo '$'.number_format($pago['saldo_insoluto'],2); ?></td>
		</tr>
		<?php endforeach; ?>
<tr>
	<td>Total: </td>
	<td> </td>
	<td><?php echo '$'.number_format($credito['Credito']['total_capital'],2)?></td>
	<td><?php echo '$'.number_format($credito['Credito']['total_interes'],2)?></td>
	<td><?php echo '$'.number_format($credito['Credito']['total_iva'],2)?></td>
	<td><?php echo '$'.number_format($credito['Credito']['total_pago'],2)?></td>
</tr>
</table>