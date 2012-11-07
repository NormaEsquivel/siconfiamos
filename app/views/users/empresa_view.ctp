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
<h3>Directorio de empresas</h3>
<br>
<?php echo $this->Html->link('Añadir Empresa',array('controller'=>'empresas','action'=>'add')); ?>
<br>
<br>
<table>
	<tr>
		<th>Nombre:</th>
	</tr>
<?php $i = 1; foreach($empresas as $empresa): ?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $empresa['Empresa']['nombre'] ?></td>
<td><?php echo $this->Html->link('Ver Empresa',array('controller'=>'empresas','action'=>'cliente_view',$empresa['Empresa']['id'])); ?></td>
<td><?php echo $this->Html->link('Incidencia',array('controller'=>'clientes','action'=>'incidencia',$empresa['Empresa']['id'])); ?></td>
<td><?php echo $this->Html->link('Estado de cuenta', array('controller'=>'incidencias','action'=>'estado',$empresa['Empresa']['id'])) ?></td>
<!-- <td><?php //echo $this->Html->link('Ver pagos atrasados', array('controller'=>'empresas','action'=>'pagosatrasados',$empresa['Empresa']['id'])) ?></td> -->
<td><?php echo $this->Html->link('Eliminar', array('controller'=>'empresas','action'=>'delete',$empresa['Empresa']['id'])) ?></td>
</tr>
<?php endforeach; ?>
</table>

