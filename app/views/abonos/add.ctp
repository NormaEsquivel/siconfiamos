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
<h3>¿Qué desea hacer a continuación?</h3>
<?php echo $this->Html->link('Aplicar más pagos', array('controller' => 'abonos', 'action' => 'elegir_empresa')); ?><br>
<?php echo $this->Html->link('Ver los pagos aplicados', array('controller' => 'cobros', 'action' => 'view', $id)); ?>
