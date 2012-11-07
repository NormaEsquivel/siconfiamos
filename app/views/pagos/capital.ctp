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
<h2>Módulo de Abono a Capital</h2>
<?php echo $this->Form->create('Pago',array('action'=>'capital')); ?>
<?php echo $this->Form->input('id',array('type' => 'hidden', 'value' => $id)); ?>	
<?php echo $this->Form->input('abono',array('label'=>'Cantidad a abonar:')); ?> 
<?php echo $this->Form->end('Abonar');?>
<br />