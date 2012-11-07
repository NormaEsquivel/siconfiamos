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
<h1>Editar Empresa</h1>
<?php
echo $this->Form->create('Empresa', array('action'=>'add'));
echo $this->Form->input('nombre',array('label'=>'Nombre(s) de la Empresa:'));
echo $this->Form->input('representante',array('label'=>'Representante:'));
echo $this->Form->input('direccion',array('label'=>'Dirección:'));
echo $this->Form->input('ciudad',array('label'=>'Ciudad'));
echo $this->Form->input('estado',array('label'=>'Estado'));
echo $this->Form->input('codigo_postal',array('label'=>'Código Postal:'));
echo $this->Form->input('telefono',array('label'=>'Teléfono:'));
echo $this->Form->input('rfc',array('label'=>'RFC:'));
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('user_id',array('type'=>'hidden'));
echo $this->Form->end('Guardar')
?>