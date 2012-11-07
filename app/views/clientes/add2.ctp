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
<h1>Seleccione la empresa a la que pertenece el cliente que desea añadir:</h1>

<table>
<?php foreach($empresas as $empresa): ?>
	<tr><td><?php echo $this->Html->link($empresa['Empresa']['nombre'],array('controller'=>'empresas','action'=>'sesion',$empresa['Empresa']['id']));?></td></tr>
	<?php endforeach; ?>
</table>	
	<?php echo $this->Html->link('Añadir una empresa',array('controller'=>'empresas','action'=>'add'));?>
