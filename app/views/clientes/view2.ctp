<?php
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Cotizar Credito', 
			array(
				'controller' => 'creditos',
				'action' => 'cotizar'
			)
		)
	),
	'element1' => array(
		'name' => $this->Html->link('Nuevo Cliente', 
			array(
				'controller' => 'clientes',
				'action' => 'add'
			)
		)
	),
	'element2' => array(
		'name' => $this->Html->link('Finalizar Sesión', 
			array(
				'controller' => 'users',
				'action' => 'logout'
			)
		)
	)
);
$firstElementClass = 'current';
$secondElementClass = '';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));

$this->Html->script('src/views/templates/index.js', array('inline' => false));

?>

<table class="table responsive-table" id="sorting-advanced">

	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col" class="align-center">Nombre</th>
			<th scope="col" class="align-center">Empresa</th>
			<th scope="col" width = "40%" class="align-center">Acciones</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="6">
				<?php echo count($clientes) . ' Clientes fueron encontrados'; ?>
			</td>
		</tr>
	</tfoot>

	<tbody>
		<?php foreach($clientes as $key => $cliente): ?>
			<tr>
				<td><?php echo $key+1; ?>
				<td><?php echo $cliente['Cliente']['full_name']; ?></td>
				<td><?php echo $cliente['Empresa']['nombre']; $cliente['Empresa']['nombre'] != null ? ' (' . $cliente['Empresa']['nombre'] . ')' : ''; ?></td>
				<td class="low-padding align-center">
					<?php 
					echo $this->Html->link('Ver',
						array(
							'controller' => 'clientes',
							'action' => 'view',
							$cliente['Cliente']['id']
						),
						array(
							'class' => 'button compact icon-card'
						)
					); 
					?>
					<?php 
					echo $this->Html->link('Historial',
						array(
							'controller' => 'creditos',
							'action' => 'historial',
							$cliente['Cliente']['id']
						),
						array(
							'class' => 'button compact icon-drawer'
						)
					); 
					?>
					<?php 
					echo $this->Html->link('Crédito',
						array(
							'controller' => 'creditos',
							'action' => 'view',
							$cliente['Cliente']['id']
						),
						array(
							'class' => 'button compact icon-folder'
						)
					); 
					?>
					<?php 
					echo $this->Html->link('Eliminar', 
						array(
							'controller' => 'clientes',
							'action' => 'view',
							$cliente['Cliente']['id']
						),
						array(
							'class' => 'button compact icon-cross'
						)
					); 
					?>
					</td>
			</tr>
		<?php endforeach;?>
	</tbody>

</table>