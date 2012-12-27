<head>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
		?>
</head>

<?php echo $this->Form->create('Credito',array('controller'=>'creditos', 'action'=>'creditos_detalle')); ?>
<?php echo $this->Form->input('fecha_inicio', array('class' => 'calendar'));?>
<?php echo $this->Form->input('fecha_final', array('class' => 'calendar'));?>
<?php echo $this->Form->end('Buscar')?>

<fieldset>
	<legend>Reporte de cobros detallado</legend>
	<table>
		<tr>
			<th>Empresa</th>
			<th>Cliente</th>
			<th>Saldo inicial</th>
			<th>Prestamo</th>
			<th>Pagos</th>
			<th>Saldo</th>
			<th></th>
			<th>Saldo inicial</th>
			<th>Prestamo</th>
			<th>Pagos</th>
			<th>Saldo</th>
			<th></th>
			<th>Saldo inicial</th>
			<th>Prestamo</th>
			<th>Pagos</th>
			<th>Saldo</th>
			<th></th>
			<th>Saldo</th>
		</tr>
		<?php
			$totalsaldoini=0;
			$totalsaldoini_interes=0;
			$totalsaldoini_iva=0;
			$totalprestamo=0;
			$totalpagos=0;
			$totalsaldo=0;
			$totalpagos_intereses=0;
			$totalpagos_iva=0;
			$totalprestamo_intereses=0;
			$totalprestamo_iva=0;
			$totalSaldo_interes=0;
			$totalSaldo_iva=0;
			$totalSaldoTotal=0;
			foreach($total as $key => $total):
			?>
		<tr>
			<td><strong><?php echo $total['empresa'];?></strong></td>
			<td><?php echo $key; ?></td>
			<td>$<?php echo round($total['saldoinicial'],2);?></td>
			<td>$<?php echo round($total['Prestamo'],2);?></td>
			<td>$<?php echo round($total['pagos'],2);?></td>
			<td>$<?php echo round($total['saldo'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($total['Saldo_inicial_interes'],2);?></td>
			<td>$<?php echo round($total['Prestamo_interes'],2);?></td>
			<td>$<?php echo round($total['interes'],2);?></td>
			<td>$<?php echo round($total['Saldo_interes'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($total['Saldo_inicial_iva'])?></td>
			<td>$<?php echo round($total['Prestamo_iva'],2);?></td>
			<td>$<?php echo round($total['iva'],2);?></td>
			<td>$<?php echo round($total['Saldo_iva'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($total['Saldototal'],2);?></td>
		</tr>
		<?php
			$totalsaldoini=$totalsaldoini+$total['saldoinicial'];
			$totalsaldoini_interes=$totalsaldoini_interes + $total['Saldo_inicial_interes'];
			$totalsaldoini_iva=$totalsaldoini_iva + $total['Saldo_inicial_iva'];
			$totalprestamo=$totalprestamo+$total['Prestamo'];
			$totalpagos=$totalpagos+$total['pagos'];
			$totalsaldo=$totalsaldo+$total['saldo'];
			$totalpagos_intereses=$totalpagos_intereses+$total['interes'];
			$totalpagos_iva=$totalpagos_iva+$total['iva'];
			$totalprestamo_intereses=$totalprestamo_intereses+$total['Prestamo_interes'];
			$totalprestamo_iva=$totalprestamo_iva+$total['Prestamo_iva'];
			$totalSaldo_interes=$totalSaldo_interes+$total['Saldo_interes'];
			$totalSaldo_iva=$totalSaldo_iva+$total['Saldo_iva'];
			$totalSaldoTotal=$totalSaldoTotal+$total['Saldototal'];
			?>
		<tr>
			<td><?php?></td>
			<td><?php?></td>
			<td><strong>$<?php echo round($totalsaldoini,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos,2);?></strong></td>
			<td><strong>$<?php echo round($totalsaldo,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalsaldoini_interes,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo_intereses,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos_intereses,2);?></strong></td>
			<td><strong>$<?php echo round($totalSaldo_interes,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalsaldoini_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalSaldo_iva,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalSaldoTotal,2);?></strong></td>
		</tr>
		<?php	
			endforeach;
		?>
	</table>
</fieldset>