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
<?php
echo $this->Form->create('Aval', array('controller'=>'aval','action'=>'add2'));
echo $this->Form->input('nombre',array('label'=>'Nombre(s) del Aval:'));
echo $this->Form->input('apellido_paterno',array('label'=>'Apellido Paterno:'));
echo $this->Form->input('apellido_materno',array('label'=>'Apellido Materno:'));
echo $this->Form->input('direccion',array('label'=>'Dirección:'));
echo $this->Form->input('colonia',array('label'=>'Colonia:'));
echo $this->Form->input('localidad',array('label'=>'Localidad:'));
echo $this->Form->input('estado',array('label'=>'Estado'));
echo $this->Form->input('codigo_postal',array('label'=>'Código Postal:'));
echo $this->Form->input('telefono_1',array('label'=>'Teléfono 1:'));
echo $this->Form->input('telefono_2',array('label'=>'Teléfono 2:'));
echo $this->Form->input('fecha_nacimiento', array( 'type'=>'date','label' => 'Fecha de nacimiento', 'dateFormat' => 'DMY', 'minYear' => date('Y')-70, 'maxYear' => date('Y')-20));
echo $this->Form->input('rfc',array('label'=>'RFC:'));
echo $this->Form->input('identificacion',array('label'=>'No. de Identificación:'));
echo $this->Form->input('curp',array('label'=>'CURP'));
echo $this->Form->input('cliente_id',array('type'=>'hidden'));
echo $this->Form->end('Guardar.')
?>