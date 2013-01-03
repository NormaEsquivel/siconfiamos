
<head>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
		?>
</head>
<fieldset>
<?php echo $this->Form->create('Abono',array('controller'=>'abonos', 'action'=>'buscar_empresa')); ?>
	<legend>Reporte 2</legend>
	
<?php echo $this->Form->input('fecha_inicio', array('class' => 'calendar'));?>
<?php echo $this->Form->input('fecha_final', array('class' => 'calendar'));?>
<?php echo $this->Form->end('Buscar')?>

<br>
<br>
<table>
	<tr>
		<th>Empresa</th>
		<th>Capital</th>
		<th>Interes</th>
		<th>IVA</th>
		<th>Total</th>
	</tr>
<?php
$totalcap=0;
$totalint=0;
$totaliva=0;
$totaltot=0;
if($total!=null):	
foreach($total as $key => $nomempresa):
foreach($empresas as $empresa)
?>
<tr>
	<td><strong><?php echo $key; ?></strong></td>
	<td>$<?php echo $nomempresa['Capital'];?></td>
	<td>$<?php echo $nomempresa['Interes'];?></td>
	<td>$<?php echo $nomempresa['Iva'];?></td>
	<td>$<?php echo $nomempresa['t'];?></td>
</tr>
<?php
$totaltot=$totaltot + $nomempresa['Capital'] + $nomempresa['Interes'] + $nomempresa['Iva'];
$totalcap=$totalcap + $nomempresa['Capital'];
$totalint=$totalint + $nomempresa['Interes'];
$totaliva=$totaliva + $nomempresa['Iva'];

endforeach;
?>
<tr>
	<td><strong>TOTAL:</strong></td>
	<td><strong>$<?php echo $totalcap; ?></strong></td>
	<td><strong>$<?php echo $totalint; ?></strong></td>
	<td><strong>$<?php echo $totaliva; ?></strong></td>
	<td><strong>$<?php echo $totaltot; ?> </strong></td>
</tr>
<?php endif;?>
</table>
</fieldset>