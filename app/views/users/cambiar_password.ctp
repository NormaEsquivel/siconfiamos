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
<h1>Cambiar contraseña</h1>
<?php
	echo $this->Form->create('User', array('action' => 'cambiar_password'));
	echo $this->Form->input('psword',array('label'=>'Contraseña:'));
	echo $this->Form->input('password',array('label'=>'Nueva contraseña:'));
	echo $this->Form->input('passwd',array('label'=>'Confirmar contraseña:'));
?>

<?php echo $this->Form->end('Cambiar contraseña');
?>
