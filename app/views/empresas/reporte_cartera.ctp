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

<?php echo $this->Form->create('Empresa',array('action'=>'reporteCartera')); ?>
<fieldset>
	<legend>Elija el intervalo de fechas:</legend>
	<?php echo $this->Form->input('fecha_inicio', array(
														'label'=>'Fecha de Inicio:',
														'class' => 'calendar',
														'dateFormat'=>'MY',
														'minYear'=>date('Y')-5,
														'maxYear'=>date('Y')+5
														)); ?>
	<?php echo $this->Form->input('fecha_final', array(
													'label'=>'Fecha Final:',
													'class' => 'calendar',
													'dateFormat'=>'MY',
													'minYear'=>date('Y')-5,
													'maxYear'=>date('Y')+5
													)); ?>
	<?php echo $this->Form->end('Calcular'); ?>
</fieldset>
<h2>Reporte de Cartera</h2>
<br>

<table>
	<tr>
		<th>Empresa</th>
		<th>#</th>
		<th>Nombre</th>
		<th>Tasa</th>
		<th>Periodo Cuotas</th>
		<th>Tiempo (mes)</th>
		<th>Prestamo</th>
		<th>Estado</th>
		<th>Pago actual</th>
		<th>Pago realizado</th>
		<th>Letra</th>
		<th>Capital/mes</th>
		<th>Interes/mes</th>
		<th>Iva/mes</th>
		<th>Letra/mes</th>
	</tr>
	<?php 
		foreach($informacion as $empresa => $clientes):
		$i = 1;
	 ?>
	<tr>
		<td><?php echo $empresa; ?></td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
	</tr>
		<?php
		$total_capital = 0;
		$total_interes = 0;
		$total_iva = 0;
		$total_letra = 0; 
		foreach($clientes as $cliente => $creditos): ?>
			<?php foreach($creditos as $credito_id => $pago):
				$total_capital = $total_capital + round($pago['capital/mes'], 2);
				$total_interes = $total_interes + round($pago['interes/mes'], 2);
				$total_iva = $total_iva + round($pago['iva/mes'], 2);
				$total_letra = $total_letra + round($pago['letra/mes'], 2);
			 ?>
			<tr>
				<td> </td>
				<td><?php echo $i++; ?></td>
				<td><?php echo $cliente; ?></td>
				<td><?php echo $pago['tasa']; ?></td>
				<td><?php echo $pago['periodo_cuotas']; ?></td>
				<td><?php echo number_format($pago['tiempo'], 2); ?></td>
				<td>$<?php echo number_format($pago['prestamo'], 2); ?></td>
				<td><?php echo $pago['estado']; ?></td>
				<td><?php echo $pago['pago/actual']; ?></td>
				<td><?php echo $pago['pagos/mes']; ?></td>
				<td>$<?php echo number_format($pago['pago'], 2); ?></td>
				<td>$<?php echo number_format($pago['capital/mes'], 2); ?></td>
				<td>$<?php echo number_format($pago['interes/mes'], 2); ?></td>
				<td>$<?php echo number_format($pago['iva/mes'], 2); ?></td>
				<td>$<?php echo number_format($pago['letra/mes'],2); ?></td>
			</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
		<tr>
			<td>Total <?php echo $empresa; ?>:</td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td>$<?php echo number_format($total_capital, 2); ?></td>
			<td>$<?php echo number_format($total_interes, 2); ?></td>
			<td>$<?php echo number_format($total_iva, 2); ?></td>
			<td>$<?php echo number_format($total_letra, 2); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
<br>
<?php echo $this->Html->link($this->Html->image('icon_excel.png'), array('controller' => 'empresas', 'action' => 'exportar_cartera'), array('escape' => false, 'title' =>'Exportar')); ?>
