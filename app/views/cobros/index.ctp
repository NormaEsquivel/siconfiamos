<?php
$menu_elements = array(
	'element2' => array(
		'name' => $this->Html->link('Finalizar Sesión', 
			array(
				'controller' => 'users',
				'action' => 'logout'
			)
		)
	)
);
$firstElementClass = '';
$secondElementClass = '';
$thirdElementClass = 'current';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
	$this->Html->script('src/views/cobros/index.js', array('inline' => false));
?>
<h3 class = "thin underline">Historial de Cobros</h3>
<table class="table responsive-table" id="sorting-advanced">
	<thead>
		<tr>
			<th>#</th>
			<th>Empresa</th>
			<th>Cantidad depositada</th>
			<th>Fecha de depósito</th>
			<th>Fecha de alta en el sistema</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($cobros as $cobro): ?>
			<tr>
				<td><?php echo $cobro['Cobro']['id']; ?></td>
				<td><?php echo $this->Html->link($cobro['Empresa']['nombre'], array('action' => 'view', $cobro['Cobro']['id'])); ?></td>
				<td>$<?php echo number_format($cobro['Cobro']['deposito'], 2); ?></td>
				<td><?php echo $cobro != null ? date('d/m/Y', strtotime($cobro['Cobro']['fecha'])) : date('d/m/Y', strtotime($cobro['Cobro']['created'])) ; ?></td>
				<td><?php echo date('d/m/Y', strtotime($cobro['Cobro']['created'])); ?></td>
			</tr>
		<?php endforeach; ?>	
	</tbody>
	<tfoot>
		<tr>
			<td colspan="6">
				<?php echo count($cobros) . ' Cobros fueron encontrados'; ?>
			</td>
		</tr>
	</tfoot>
</table>