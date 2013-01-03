<!--<?php pr($clientes); ?>-->
<head>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
		?>
</head>
<fieldset>
	
	<?php echo $this->Form->create('Abono',array('controller'=>'abonos', 'action'=>'empresa_detalle')); ?>

		<legend>Reporte de Cobro Detallado  </legend>

<?php echo $this->Form->input('fecha_inicio', array('class' => 'calendar'));?>
<?php echo $this->Form->input('fecha_final', array('class' => 'calendar'));?>
<?php echo $this->Form->end('Buscar')?>
<table>
	<tr>
		<th>Empresa</th>
		<th>Empleado</th>
		<th>Capital</th>
		<th>Interes</th>
		<th>Iva</th>
		<th>Total</th>
	</tr>
<?php 
$totalcap=0;
$totalint=0;
$totaliva=0;
$totaltot=0;

foreach($arreglo as $key => $detalle):
	// if(!isset($key)):?>
	<tr>	
		<td><?php  echo $detalle['empresa']; ?></td>
		<td><?php echo $key;?></td>			
		<td>$<?php echo round($detalle['Capital'],2);?></td>
		<td>$<?php echo round($detalle['Interes'],2);?></td>
		<td>$<?php echo round($detalle['Iva'],2);?></td>
		<td>$<?php echo round($detalle['t'],2);?></td>
	</tr>
<?php
$totaltot=$totaltot + round($detalle['Capital'],2) + $detalle['Interes'] + round($detalle['Iva'],2);
$totalcap=$totalcap + round($detalle['Capital'],2);
$totalint=$totalint + round($detalle['Interes'],2);
$totaliva=$totaliva + round($detalle['Iva'],2);
	// endif;
//pr($detalle);
?>
<tr>
	<td><?php?></td>
	<td><strong>Total</strong></td>
	<td><strong>$<?php echo $totalcap; ?></strong></td>
	<td><strong>$<?php echo $totalint; ?></strong></td>
	<td><strong>$<?php echo $totaliva; ?></strong></td>
	<td><strong>$<?php echo round($totaltot,2); ?></strong></td>
</tr>
<?php	
endforeach;
?>
</table>
</fieldset>
