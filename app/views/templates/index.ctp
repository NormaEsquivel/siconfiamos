<?php
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Nuevo Cliente', 
			array(
				'controller' => 'templates',
				'action' => 'add_client'
			)
		)
	),
	'element1' => array(
		'name' => $this->Html->link('Victor', 
			array(
				'controller' => 'templates',
				'action' => 'add_client'
			)
		)
	),
	'element2' => array(
		'name' => $this->Html->link('Login', 
			array(
				'controller' => 'templates',
				'action' => 'login'
			)
		)
	),
);

$this->set(compact('menu_elements'));

$this->Html->script('src/views/templates/index.js', array('inline' => false));

?>

<table class="table responsive-table" id="sorting-advanced">

	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col" class="align-center hide-on-mobile">Nombre</th>
			<th scope="col" class="align-center hide-on-mobile-portrait">Empresa</th>
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
							'controller' => 'templates',
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
							'controller' => 'templates',
							'action' => 'credit_history',
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
							'controller' => 'templates',
							'action' => 'active_credit',
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