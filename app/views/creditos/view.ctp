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
<h2>Crédito de <?php echo $credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno']?></h2>
<br>
<?php echo $this->Html->link('Historial de Crédito',array('action'=>'historial',$credito['Cliente']['id'])); ?>
<br>
<?php echo $this->Html->link('Información de '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'], array('controller' => 'clientes', 'action' => 'view', $credito['Cliente']['id'])); ?>
<br>
<br>
<table>
<tr>
<th>Fecha:</th>
<th>Número de cheque:</th>
<th>Tasa de Interés:</th>
<th>Número de cuotas:</th>
<th>Periodo de cuotas:</th>
<th>Préstamo:</th>
<th>Fecha de cálculo:</th>
<th>Tipo de cálculo:</th>
</tr>
<tr>
		<td><?php echo $credito['Credito']['fecha']; ?></td>
		<td><?php echo $credito['Credito']['cheque']; ?></td>
		<td><?php echo $credito['Credito']['tasa_interes']; ?></td>
		<td><?php echo $credito['Credito']['cuotas'];; ?></td>
		<td><?php echo $credito['Credito']['periodo_cuotas']; ?></td>
		<td>$<?php echo number_format($credito['Credito']['prestamo'], 2); ?></td>
		<td><?php echo $credito['Credito']['fecha_calculo']; ?></td>
		<td><?php echo $credito['Credito']['tipo_calculo'];  ?></td>
</tr>
</table>
<br>
<table><tr><td><?php echo $this->Html->link('PDF Pagos',array('controller'=>'pagos','action'=>'imprimirpdf',$credito['Credito']['id'])); ?></td>
	<td><?php echo $this->Html->link('Contrato',array('action'=>'contrato',$credito['Credito']['id'])); ?></td>
	<td><?php echo $this->Html->link('Finalizar Crédito',array('action'=>'borrarcredito',$credito['Credito']['id'])); ?></td>
	<td><?php echo $this->Html->link('Liquidar crédito',array('controller' => 'creditos', 'action' => 'liquidar', $credito['Credito']['id'], $credito['Cliente']['id'])); ?></td></tr>	
</table>
<br>
<br>
<h3>Pagos</h3>
<table>
	<tr>
		<th>Fecha Expedición:</Th>
		<th>Numero de pago:</th>
		<th>Cargo:</th>
		<th>Pago de capital:</Th>
		<th>Saldo:</th>		
		<th>Cargo:</th>
		<th>Intereses:</Th>
		<th>Saldo:</th>
		<th>Cargo</th>
		<th>IVA:</Th>
		<th>Saldo:</th>
		<th>Pago:</Th>
		<th>Saldo Insoluto:</Th>
		<!--<th>Situación:</Th>-->
	</tr>
<?php 
	$total_capital = 0;
	$total_interes = 0;
	$total_iva = 0;
	$total_pago = 0;
	$saldo_capital=0;
	$saldo_interes=0;
	$saldo_iva=0;
?>
	<?php foreach($pagos as $pago): 
		foreach ($totales as $key => $total):?>
		<?php 
		$total_capital = $total_capital + $pago['Pago']['pago_capital'];
		$total_interes = $total_interes + $pago['Pago']['intereses'];
		$total_iva = $total_iva + $pago['Pago']['iva_intereses'];
		$total_pago = $total_pago + $pago['Pago']['pago'];
		$saldo_capital=round($total_capital,2) - round($pago['Pago']['pago_capital'],2);
		$saldo_interes=round($total_interes,2)-round($pago['Pago']['intereses'],2);
		$saldo_iva=round($total_iva,2) - round($pago['Pago']['iva_intereses'],2);
		?>
		<tr>	
			<td><?php echo $pago['Pago']['fecha']; ?></td>
			<td><?php echo $pago['Pago']['numero_pago']; ?></td>
			<td><?php echo $credito['Credito']['prestamo']?></td>
			<td><?php echo '$'.number_format($pago['Pago']['pago_capital'],2); ?></td>
			<td><?php echo round($saldo_capital,2); ?></td>
			<td><?php echo $total['Intereses']; ?></td>
			<td><?php echo '$'.number_format($pago['Pago']['intereses'],2); ?></td>
			<td><?php echo round($saldo_interes,2);?></td>
			<td><?php echo $total['Iva'] ?></td>
			<td><?php echo '$'.number_format($pago['Pago']['iva_intereses'],2); ?></td>
			<td><?php echo round($saldo_iva,2)?></td>
			<td><?php echo '$'.number_format($pago['Pago']['pago'],2); ?></td>
			<td><?php echo '$'.number_format($pago['Pago']['saldo_insoluto'],2); ?></td>
			<!--<td><?php echo $pago['Pago']['sitacion']; ?></td>-->
			
		</tr>
		<?php endforeach; 
		endforeach;?>
		<tr>	
			<td>Total:</td>
			<td> </td>
			<td> </td>
			<td>$<?php echo number_format($total_capital,2); ?></td>
			<td> </td>
			<td> </td>
			<td>$<?php echo number_format($total_interes,2); ?> </td>
			<td> </td>
			<td> </td>
			<td>$<?php echo number_format($total_iva,2); ?></td>
			<td> </td>
			<td>$<?php echo number_format($total_pago,2); ?></td>
			<td> </td>
			<!--<td> </td>
			<td> </td>-->		
		</tr>
		
</table>
<br>
<br>
<br>
<?php echo $this->Html->link('Reporte 3', array('conroller' => 'creditos', 'action'=>'saldo_creditos')); ?>
