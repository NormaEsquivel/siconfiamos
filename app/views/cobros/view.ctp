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
	$this->Html->script('src/views/cobros/view.js', array('inline' => false));
?>
<h3 class = "thin underline">Pagos de <?php echo $cobro['Empresa']['nombre']; ?> (<?php echo date('d/m/Y', strtotime($cobro['Cobro']['created'])); ?>)</h3>
<table class="table responsive-table" id="sorting-advanced">
	<thead>
		<tr>
			<th><?php echo 'Cliente'; ?></th>
			<th>Cantidad depositada</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$total = 0; 
		foreach($cobro['Abono'] as $abono): 
		?>
			<tr>
				<td><?php echo $this->Html->link($abono['Cliente']['Cliente']['full_name'], array('controller' => 'abonos', 'action' => 'view', $abono['id'])); ?></td>
				<td>$<?php echo $abono['abono']; ?></td>
			</tr>
		<?php
		$total = $total + $abono['abono'];  
		endforeach; 
		?>
		<tr>
			<td><strong>Total:</strong></td>
			<td>$<?php echo $total; ?></td>
		</tr>	
	</tbody>
</table>