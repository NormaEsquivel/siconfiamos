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
<h4>Editar Referencia Familiar</h4>

<?php echo $this->Form->create('Familiar',array('action'=>'edit'));
echo $this->Form->input('nombre',array('label'=>'Nombre:'));
echo $this->Form->input('parentesco',array('label'=>'Parentesco:'));
echo $this->Form->input('estado_civil',array('label'=>'Estado Civil:'));
echo $this->Form->input('direccion',array('label'=>'Dirección:'));
echo $this->Form->input('colonia',array('label'=>'Colonia:'));
echo $this->Form->input('localidad',array('label'=>'Localidad:'));
echo $this->Form->input('estado',array('label'=>'Estado:'));
echo $this->Form->input('codigo_postal',array('label'=>'Código Postal:'));
echo $this->Form->input('telefono',array('label'=>'Teléfono:'));
echo $this->Form->input('cliente_id',array('type'=>'hidden'));
echo $this->Form->end('Guardar');
?>