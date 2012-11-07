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
<h2>Referencias Familiares</h2>

<table>
<tr><th>Nombre:</th>
<th>Parentesco:</th>
<th>Estado Civil:</th>
<th>Dirección:</th>
<th>Colonia:</th>
<th>Localidad:</th>
<th>Estado:</th>
<th>Código Postal:</th>
<th>Teléfono:</th></tr>

<tr>
<td><?php echo $familiar['Familiar']['nombre'];?></td>
<td><?php echo $familiar['Familiar']['parentesco'];?></td>
<td><?php echo $familiar['Familiar']['estado_civil'];?></td>
<td><?php echo $familiar['Familiar']['direccion'];?></td>
<td><?php echo $familiar['Familiar']['colonia'];?></td>
<td><?php echo $familiar['Familiar']['localidad'];?></td>
<td><?php echo $familiar['Familiar']['estado'];?></td>
<td><?php echo $familiar['Familiar']['codigo_postal'];?></td>
<td><?php echo $familiar['Familiar']['telefono'];?></td>
</tr>
</table>



<?php echo $this->Html->link('Editar', array('controller' => 'familiars', 'action' => 'edit', $familiar['Familiar']['id'])); ?>
<br>
<?php echo $this->Html->link('Ver Cliente', array('controller' => 'clientes', 'action' => 'view', $familiar['Familiar']['cliente_id'])); ?>
<br>
<?php echo $this->Html->link('Menú Clientes', array('controller' => 'empresas', 'action' => 'cliente_view', $familiar['Cliente']['empresa_id'])); ?>
<br>
<?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>