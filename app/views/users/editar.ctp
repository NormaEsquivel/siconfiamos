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
<h1>Editar Información</h1>
<?php
	echo $this->Form->create('User', array('action' => 'editar'));
	echo $this->Form->input('name',array('label'=>'Nombre de Usuario:'));
	echo $this->Form->input('nombre',array('label'=>'Nombre:'));
	echo $this->Form->input('apellido',array('label'=>'Apellido:'));
	echo $this->Form->input('direccion',array('label'=>'Dirección:'));
	echo $this->Form->input('telefono',array('label'=>'Teléfono:'));
	echo $this->Form->input('curp',array('label'=>'CURP:'));
	echo $this->Form->input('rfc',array('label'=>'RFC:'));
	echo $this->Form->input('ID',array('type'=>'hidden'));
	echo $this->Form->button('Restaurar',array('type'=>'reset'));
?>

<?php echo $this->Form->end('Editar');
?>
