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
if($arreglo!=null):
foreach($arreglo as $key => $detalle):
?>
	<tr>	
		<td><?php  echo $key; ?></td>
		<td></td>			
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<?php
foreach($detalle as $key2=> $totals):
?>

<?php
$totaltot=$totaltot + round($totals['Capital'],2) + $totals['Interes'] + round($totals['Iva'],2);
$totalcap=$totalcap + round($totals['Capital'],2);
$totalint=$totalint + round($totals['Interes'],2);
$totaliva=$totaliva + round($totals['Iva'],2);
?>
<tr>	
	<td></td>
	<td><?php echo $key2;?></td>			
	<td>$<?php echo round($totals['Capital'],2);?></td>
	<td>$<?php echo round($totals['Interes'],2);?></td>
	<td>$<?php echo round($totals['Iva'],2);?></td>
	<td>$<?php echo round($totals['t'],2);?></td>
</tr>
<?php endforeach?>
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
endif;
?>
</table>
</fieldset>
