<?php pr($cobro) ?>
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
<h3>Pagos de <?php echo $cobro['Empresa']['nombre']; ?> (<?php echo date('d/m/Y', strtotime($cobro['Cobro']['created'])); ?>)</h3>
<table>
	<tr>
		<th><?php echo 'Cliente'; ?></th>
		<th>Cantidad depositada</th>
		<th>Fecha</th>
		<th>Fecha Pago</th>
		<th>Numero de pago</th>
		<th> Capital</th>
	</tr>
	
	
	<?php
	$total = 0; 
	foreach($cobro['Abono'] as $abono): 
	?>
		<tr>
			<td><?php echo $this->Html->link($abono['Cliente']['Cliente']['full_name'], array('controller' => 'abonos', 'action' => 'view', $abono['id'])); ?></td>
			<td>$<?php echo $abono['abono']; ?></td>
				
				
			<td><?php echo $abono['fecha']; ?></td>
			<td><?php echo $abono['fecha_pago']; ?></td>
			<td><?php echo $abono['numero_pago']; ?></td>
			<td><?php echo $abono['pago_capital']; ?></td>
			
		</tr>
	<?php
	$total = $total + $abono['abono'];  
	endforeach; 
	?>
	<tr>
		<td><strong>Total:</strong></td>
		<td>$<?php echo $total; ?></td>
	</tr>	
	
		
</table>