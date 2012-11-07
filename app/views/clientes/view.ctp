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
<h2>Información del cliente</h2>
<table>
<tr>
<th>Nombre:</th>
<th>Apellido Paterno:</th>
<th>Apellido Materno:</th>
<th>Dirección</th>
<th>Colonia</th>
<th>Localidad</th>
<th>Estado</th>
<th>Telefono 1</th>
<th>Telefono 2</th>
<th>C.P.</th>
<th>Fecha de Nacimiento</th>
<th>Dependientes Económicos</th>
<th>RFC</th>
<th>IFE</th>
<th>CURP</th>
<th>Antigüedad</th>
</tr>
<tr>
<td><?php echo $cliente['Cliente']['nombre'];?></td>
<td><?php echo $cliente['Cliente']['apellido_paterno'];?></td>
<td><?php echo $cliente['Cliente']['apellido_materno'];?></td>
<td><?php echo $cliente['Cliente']['direccion'];?></td>
<td><?php echo $cliente['Cliente']['colonia'];?></td>
<td><?php echo $cliente['Cliente']['localidad'];?></td>
<td><?php echo $cliente['Cliente']['estado'];?></td>
<td><?php echo $cliente['Cliente']['telefono_1'];?></td>
<td><?php echo $cliente['Cliente']['telefono_2'];?></td>
<td><?php echo $cliente['Cliente']['codigo_postal'];?></td>
<td><?php echo $cliente['Cliente']['fecha_nacimiento'];?></td>
<td><?php echo $cliente['Cliente']['dependientes'];?></td>
<td><?php echo $cliente['Cliente']['rfc'];?></td>
<td><?php echo $cliente['Cliente']['identificacion'];?></td>
<td><?php echo $cliente['Cliente']['curp'];?></td>
<td><?php echo $cliente['Cliente']['antiguedad_laboral'];?></td>
</tr>
</table>


<table>
	<tr>
<td><?php echo $this->Html->link('Aval', array('controller' => 'avals', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
<td><?php echo $this->Html->link('Ingresos/Egresos', array('controller' => 'ingresos', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
<td><?php echo $this->Html->link('Referencias Familiares', array('controller' => 'familiars', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
<td><?php echo $this->Html->link('Referencias Personales', array('controller' => 'personals', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
</tr>
</table>
<br>
<?php echo $this->Html->link('Editar', array('controller' => 'clientes', 'action' => 'edit', $cliente['Cliente']['id'])); ?>
<br>
<?php echo $this->Html->link($cliente['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'cliente_view', $cliente['Cliente']['empresa_id'])); ?>
<br>
<?php echo $this->Html->link('Clientes', array('controller' => 'users', 'action' => 'sesion',1)); ?>
<br>
<?php echo $this->Html->link('Empresas', array('controller' => 'users', 'action' => 'sesion',2)); ?>
<br>
<?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>