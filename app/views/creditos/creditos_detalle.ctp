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
		foreach($total as $key => $totals):
			?>
		<tr>
			<td><strong><?php echo $key; ?></strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
			foreach($totals as $key2 => $totales):
		?>
		
				<?php
			$totalsaldoini=$totalsaldoini+$totales['saldoinicial'];
			$totalsaldoini_interes=$totalsaldoini_interes + $totales['Saldo_inicial_interes'];
			$totalsaldoini_iva=$totalsaldoini_iva + $totales['Saldo_inicial_iva'];
			$totalprestamo=$totalprestamo+$totales['Prestamo'];
			$totalpagos=$totalpagos+$totales['pagos'];
			$totalsaldo=$totalsaldo+$totales['saldo'];
			$totalpagos_intereses=$totalpagos_intereses+$totales['interes'];
			$totalpagos_iva=$totalpagos_iva+$totales['iva'];
			$totalprestamo_intereses=$totalprestamo_intereses+$totales['Prestamo_interes'];
			$totalprestamo_iva=$totalprestamo_iva+$totales['Prestamo_iva'];
			$totalSaldo_interes=$totalSaldo_interes+$totales['Saldo_interes'];
			$totalSaldo_iva=$totalSaldo_iva+$totales['Saldo_iva'];
			$totalSaldoTotal=$totalSaldoTotal+$totales['Saldototal'];
			?>
			
		<tr>
			<td></td>
			<td><?php echo $key2 ?></td>
			<td>$<?php echo round($totales['saldoinicial'],2);?></td>
			<td>$<?php echo round($totales['Prestamo'],2);?></td>
			<td>$<?php echo round($totales['pagos'],2);?></td>
			<td>$<?php echo round($totales['saldo'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldo_inicial_interes'],2);?></td>
			<td>$<?php echo round($totales['Prestamo_interes'],2);?></td>
			<td>$<?php echo round($totales['interes'],2);?></td>
			<td>$<?php echo round($totales['Saldo_interes'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldo_inicial_iva'])?></td>
			<td>$<?php echo round($totales['Prestamo_iva'],2);?></td>
			<td>$<?php echo round($totales['iva'],2);?></td>
			<td>$<?php echo round($totales['Saldo_iva'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldototal'],2);?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td></td>
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