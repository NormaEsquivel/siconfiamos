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
<h2>Estado de cuenta</h2>
<table>
	<tr>
		<th>#</th>
		<th>Nombre:</th>
		<th>Pagos Realizados:</th>
		<th>Cantidad Pagada:</th>
		<th>Debe:</th>
	</tr>
	<?php
		$i = 1;
		$total_debe=0;
		$total_pagado=0; 
		foreach($estado_cuenta as $cuenta):
			$total_debe=$total_debe+$cuenta['cantidad_pago']*$cuenta['nopagos'];
			$total_pagado=$total_pagado+$cuenta['cantidad_pago']*$cuenta['pagos'];
	?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $cuenta['nombre'];?></td>
			<td><?php echo ($cuenta['pagos']).'/'.($cuenta['pagos']+$cuenta['nopagos']);?></td>
			<td><?php echo '$'.number_format($cuenta['cantidad_pago']*$cuenta['pagos'],2);?></td>
			<td><?php echo '$'.number_format($cuenta['cantidad_pago']*$cuenta['nopagos'],2);?></td>
		</tr>
	<?php endforeach;?>
		<tr>
			
			<td><?php echo 'Total: ' ?></td>
			<td> </td>
			<td> </td>
			<td><?php echo '$'.number_format($total_pagado, 2);?></td>
			<td><?php echo '$'.number_format($total_debe, 2);?></td>
		</tr>
	
</table>
