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
<h1>Información del usuario</h1>
<table>
<tr>
	<th>Nombre:</th>
	<td><?php
echo $user['User']['nombre'];?></td>
</tr>
<tr>
<th>Apellido:</th><td><?php echo $user['User']['apellido'];?></td>
</tr>
<tr>
<th>Dirección:</th><td><?php echo $user['User']['direccion'];?></td>
</tr>
<tr>
<th>Teléfono:</th><td><?php echo $user['User']['telefono'];?></td>
</tr>
<tr>
<th>CURP:</th><td><?php echo $user['User']['curp'];?></td>
</tr>
<tr>
<th>RFC:</th><td><?php echo $user['User']['rfc'];?></td>
</tr>
</table>

<br>
<?php if($user['User']['permisos']=='admin'){
	echo $this->Html->link('Registro de usuarios', array('action' => 'registro'));
}
?>

<br>
<?php echo $this->Html->link('Editar mi información', array('action' => 'editar')); ?>
<br>
<?php echo $this->Html->link('Cambiar contraseña', array('action' => 'cambiar_password'));?>

