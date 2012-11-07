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
<h1>Editar Información de Ingresos/Egresos</h1>
<?php
echo $this->Form->create('Ingreso', array('action'=>'edit'));?>

<table>
	<tr>
<td><?php
echo $this->Form->input('salario_imss',array('label'=>'Salario IMSS:')); ?></td>
<td><?php
echo $this->Form->input('egresos_imss',array('label'=>'Egreso IMSS:')); ?></td>
</tr>
	<tr>
<td><?php
echo $this->Form->input('salario_real',array('label'=>'Salario real:')); ?></td>
<td><?php
echo $this->Form->input('egresos_real',array('label'=>'Egreso real:')); ?></td>
</tr>
	<tr>
<td><?php
echo $this->Form->input('otros_ingresos',array('label'=>'Otros Ingresos:')); ?></td>
<td><?php
echo $this->Form->input('otros_egresos',array('label'=>'Otros Egresos:')); ?></td>
</tr>
<?php echo $this->Form->input('id',array('type'=>'hidden')) ?>
<?php echo $this->Form->input('cliente_id',array('type'=>'hidden')) ?>
</table>
<?php echo $this->Form->end('Guardar');?>