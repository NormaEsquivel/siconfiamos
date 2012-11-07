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
<h2>Módulo de Pagos <?php echo $cliente ?></h2>
<table>
	<tr>
		<th>Fecha</th>
		<th>Número de Pago</th>
		<th>Pago</th>
		<th>Situación</th>
		<th>Pagar</th>
	</tr>
	<?php $i=1; ?>
	<?php $cuenta=count($pagos['Pago']); ?>
<?php foreach($pagos['Pago'] as $pago): ?>
	<tr>
		<?php echo $this->Form->create('Pago',array('controller'=>'pagos','action'=>'actualizar'))?>
		<td><?php echo $pago['fecha']?></td>
		<td><?php echo $pago['numero_pago']?></td>
		<td><?php echo '$'.number_format($pago['pago'],2)?></td>
		<td><?php echo $pago['sitacion']?></td>
		<td><?php echo $this->Form->checkbox($i, array('value' => 1)); ?></td>
		<?php $i++;?>
	</tr>
<?php endforeach;?>	
</table>
<?php echo $this->Form->end('Pagar');?>
