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
<br>
<h3>Listado de Clientes: <?php echo $empresa['Empresa']['nombre'] ?> </h3>
<table>
	<tr>
		<td>Nombre:</td>
		<td>Apellido Paterno:</td>
		<td>Apellido Materno:</td>
	</tr>
		<?php foreach($clientes as $cliente): ?>
	<tr>
		<td><?php echo $cliente['Cliente']['nombre'] ?></td>
		<td><?php echo $cliente['Cliente']['apellido_paterno'] ?></td>
		<td><?php echo $cliente['Cliente']['apellido_materno'] ?></td>
		<td><?php echo $this->Html->link('Ver',array('controller'=>'clientes','action'=>'view',$cliente['Cliente']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->Html->link('Incidencias', array('controller'=>'clientes','action'=>'incidencia',$empresa['Empresa']['id'])) ?>
<br>
<?php echo $this->Html->link('Estado de cuenta', array('controller'=>'clientes','action'=>'estadodecuenta',$empresa['Empresa']['id'])) ?>
<br>
<?php echo $this->Html->link('Añadir Cliente', array('controller'=>'clientes','action'=>'add')) ?>
<br>
<?php echo $this->Html->link('Información de la empresa', array('controller'=>'empresas','action'=>'view',$cliente['Cliente']['empresa_id'])) ?>
