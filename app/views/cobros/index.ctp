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
<h3>Historial de cobros</h3>
<table>
	<tr>
		<th>#</th>
		<th>Empresa</th>
		<th>Cantidad depositada</th>
		<th><?php echo $this->Paginator->sort('Fecha de depósito', 'Cobro.fecha'); ?></th>
		<th><?php echo $this->Paginator->sort('Fecha de alta en el sistema', 'Cobro.created'); ?></th>
	</tr>
	<?php foreach($cobros as $cobro): ?>
		<tr>
			<td><?php echo $cobro['Cobro']['id']; ?></td>
			<td><?php echo $this->Html->link($cobro['Empresa']['nombre'], array('action' => 'view', $cobro['Cobro']['id'])); ?></td>
			<td>$<?php echo number_format($cobro['Cobro']['deposito'], 2); ?></td>
			<td><?php echo $cobro != null ? date('d/m/Y', strtotime($cobro['Cobro']['fecha'])) : date('d/m/Y', strtotime($cobro['Cobro']['created'])) ; ?></td>
			<td><?php echo date('d/m/Y', strtotime($cobro['Cobro']['created'])); ?></td>
		</tr>
	<?php endforeach; ?>	
</table>
<!-- Shows the page numbers -->
<?php echo $this->Paginator->numbers(); ?>
<!-- Shows the next and previous links -->
<?php echo $this->Paginator->hasPrev() ? $this->Paginator->prev('« Anterior', null, null, array('class' => 'disabled')) : null; ?>&nbsp;
<?php echo $this->Paginator->counter('Página %page% de %pages%'); ?>&nbsp;
<?php echo $this->Paginator->hasNext() ? $this->Paginator->next('Siguiente »', null, null, array('class' => 'disabled')) : null; ?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->