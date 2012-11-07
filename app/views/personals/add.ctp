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
<h2>Añadir Referencias Personales</h2>
<?php
echo $this->Form->create('Personal', array('action'=>'add'));
echo $this->Form->input('nombre',array('label'=>'Nombre:'));
echo $this->Form->input('lugar_trabajo',array('label'=>'Lugar de trabajo:'));
echo $this->Form->input('direccion',array('label'=>'Dirección:'));
echo $this->Form->input('colonia',array('label'=>'Colonia:'));
echo $this->Form->input('localidad',array('label'=>'Localidad:'));
echo $this->Form->input('estado',array('label'=>'Estado:'));
echo $this->Form->input('codigo_postal',array('label'=>'Código Postal:'));
echo $this->Form->input('telefono',array('label'=>'Teléfono:'));
?>


</table>
<?php echo $this->Form->end('Guardar');?>

