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
<h1>Elegir Empresa</h1>
<?php foreach($empresas as $empresa): ?>
	<?php 
	echo $this->Html->link($empresa['Empresa']['nombre'], array(
		'controller' => 'abonos',
		'action' => 'elegir_empleados',
		$empresa['Empresa']['id']	
	));
	?><br>
<?php endforeach; ?>
<br>
<br>
<?php echo $this->Html->link('Histórico', array('controller' => 'cobros', 'action' => 'index')); ?>
