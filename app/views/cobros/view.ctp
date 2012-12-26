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

<h3>Pagos de <?php echo $cobro['Cobro']['name']; ?> (<?php echo date('d/m/Y', strtotime($cobro['Cobro']['created'])); ?>)</h3>
<table>
	<tr>
		<th><?php echo 'Cliente'; ?></th>
		<th>Fecha</th>
		<th>Fecha Pago</th>
		<th>Pago</th>
		<th>Retencion</th>
		<th>Capital</th>
		<th>Interes</th>
		<th>IVA</th>
	</tr>
	
	
	<?php
	$total = 0; 
	$totalcap=0;
	$totalint=0;
	$totaliva=0;
	foreach($cobro['Abono'] as $abono): 
		foreach($abono['Asociation'] as $pago):
	?>

		<tr>
			<td> <?php echo $this->Html->link($abono['Cliente']['full_name'], array('controller' => 'abonos', 'action' => 'view', $abono['id'])); ?></td>
			<td><?php echo $pago['Pago']['fecha']; ?></td>
			<td><?php echo $abono['created'] ; ?></td>
			<td><?php echo $pago['Pago']['numero_pago']; ?></td>
			<td>$<?php echo $pago['abono']; ?></td>
			<td>$<?php echo round($pago['Pago']['pago_capital'],2); ?></td>
			<td>$<?php echo $pago['Pago']['intereses']; ?></td>
			<td>$<?php echo $pago['Pago']['iva_intereses']; ?></td>			
		</tr>
	<?php
	$total = $total + $pago['abono']; 
	$totalcap=round($totalcap + $pago['Pago']['pago_capital'], 2);
	$totalint=$totalint + $pago['Pago']['intereses'];
	$totaliva=$totaliva + $pago['Pago']['iva_intereses'];
		endforeach; 
	endforeach;
	?>
	<tr>
		<td><strong>Total:</strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td>$<?php echo $total; ?></td>
		<td>$<?php echo $totalcap; ?></td>
		<td>$<?php echo $totalint; ?></td>
		<td>$<?php echo $totaliva; ?></td>
	</tr>	
	
		
</table>