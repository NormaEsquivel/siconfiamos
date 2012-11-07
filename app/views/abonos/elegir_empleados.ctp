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
<?php echo $this->Html->link('« Atrás', array('action' => 'elegir_empresa')); ?>
<br/>
<br/>
<h2>Elija los clientes a los que desea aplicarles un pago</h2>

<?php
echo $this->Form->create('Abono', array(
	'url' => array(
		'action' => 'elegir_empleados', $id
	)
));
echo $this->Form->input('periodo', array(
	'type' => 'select',
	'options' => array(
		'semanal' => 'Semanal',
		'quincenal' => 'Quincenal',
		'mensual' => 'Mensual'
	)
));
echo $this->Form->end('Buscar')
?>

<table>
	<tr>
		<th>Pago</th>
		<th>Nombre</th>
	</tr>
<?php 
$i = 0;
echo $this->Form->create('Abono', array('action' => 'retrieve')); ?>
<?php foreach($clientes as $key => $cliente): ?>
	<?php if($cliente['Cliente']['credito_activo']): ?>
	<tr>
		<td>
		<?php 
			echo $this->Form->input('Abono.' . $i . '.addPay', array(
				'type' => 'checkbox',
				'label' => ''
			));
		?> 
		</td>
		<?php 
		
			echo $this->Form->input($i . '.name', array(
				'type' => 'hidden',
				'value' => $cliente['Cliente']['full_name']
			));
		
			echo $this->Form->input($i . '.id', array(
				'type' => 'hidden',
				'value' => $cliente['Cliente']['id']
			));
			
			echo $this->Form->input($i . '.empresa_id', array(
				'type' => 'hidden',
				'value' => $cliente['Cliente']['empresa_id']
			));
			$i++;
		?>
		<td><?php echo $cliente['Cliente']['full_name']; ?></td>
	</tr>
	<?php endif; ?>
<?php endforeach; ?>
</table>
<?php echo $this->Form->end('Ok'); ?>
	
