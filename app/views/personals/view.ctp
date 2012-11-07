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
<h2>Referencias Personales</h2>
<br>
<?php echo $this->Html->link('Editar', array('controller' => 'personals', 'action' => 'edit', $referencia['Personal']['id'])); ?>
<br>
<?php echo $this->Html->link('Ver Cliente', array('controller' => 'clientes', 'action' => 'view', $referencia['Personal']['cliente_id'])); ?><table>
<tr>
<th>Nombre:</th>
<th>Lugar de trabajo:</th>
<th>Dirección:</th>
<th>Colonia:</th>
<th>Localidad:</th>
<th>Estado:</th>
<th>Código Postal:</th>
<th>Teléfono:</th>
</tr>
<tr>
	<td><?php echo $referencia['Personal']['nombre'];?></td>
<td><?php echo $referencia['Personal']['lugar_trabajo'];?></td>
<td><?php echo $referencia['Personal']['direccion'];?></td>
<td><?php echo $referencia['Personal']['colonia'];?></td>
<td><?php echo $referencia['Personal']['localidad'];?></td>
<td><?php echo $referencia['Personal']['estado'];?></td>
<td><?php echo $referencia['Personal']['codigo_postal'];?></td>
<td><?php echo $referencia['Personal']['telefono'];?></td>
</tr>
</table>



