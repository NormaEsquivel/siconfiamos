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
<h2>Información del Aval</h2>
<table>
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
<th>RFC</th>
<th>IFE</th>
<th>CURP</th>
</tr>
<tr>
<td><?php echo $aval['Aval']['nombre'];?></td>
<td><?php echo $aval['Aval']['apellido_paterno'];?></td>
<td><?php echo $aval['Aval']['apellido_materno'];?></td>
<td><?php echo $aval['Aval']['direccion'];?></td>
<td><?php echo $aval['Aval']['colonia'];?></td>
<td><?php echo $aval['Aval']['localidad'];?></td>
<td><?php echo $aval['Aval']['estado'];?></td>
<td><?php echo $aval['Aval']['telefono_1'];?></td>
<td><?php echo $aval['Aval']['telefono_2'];?></td>
<td><?php echo $aval['Aval']['codigo_postal'];?></td>
<td><?php echo $aval['Aval']['fecha_nacimiento'];?></td>
<td><?php echo $aval['Aval']['rfc'];?></td>
<td><?php echo $aval['Aval']['identificacion'];?></td>
<td><?php echo $aval['Aval']['curp'];?></td>
</tr>
</table>


<?php echo $this->Html->link('Editar', array('controller' => 'avals', 'action' => 'edit', $aval['Aval']['id'])); ?>
<br>
<?php echo $this->Html->link($aval['Cliente']['nombre'], array('controller' => 'clientes', 'action' => 'view', $aval['Aval']['cliente_id'])); ?>
<br>
<?php echo $this->Html->link('Menú clientes', array('controller' => 'users', 'action' => 'sesion',1)); ?>
<br>
<?php echo $this->Html->link('Ver empresa', array('controller' => 'empresas', 'action' => 'cliente_view', $aval['Cliente']['empresa_id'])); ?>
<br>
<?php echo $this->Html->link('Menú Empresas', array('controller' => 'users', 'action' => 'sesion',2)); ?>
<br>
<?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>

