<?php
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Nueva Empresa', 
			array(
				'controller' => 'empresas',
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

$firstElementClass = '';
$secondElementClass = 'current';
$thirdElementClass = '';
$fourthElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass', 'fourthElementClass'));
$this->Html->script('src/views/users/empresa_view.js', array('inline' => false));


?>

<table class="table responsive-table" id="sorting-advanced">

	<thead>
		<tr>
			<th scope="col" class="align-center">#</th>
			<th scope="col" class="align-center">Nombre</th>
			<th scope="col" width = "40%" class="align-center">Acciones</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="6">
				<?php echo count($empresas) . ' Empresas fueron encontrados'; ?>
			</td>
		</tr>
	</tfoot>

	<tbody>
		<?php foreach($empresas as $key => $empresa): ?>
			<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $empresa['Empresa']['nombre']; ?></td>
				<td class="low-padding align-center">
					<?php 
					echo $this->Html->link('Ver',
						array(
							'controller' => 'empresas',
							'action' => 'cliente_view',
							$empresa['Empresa']['id']
						),
						array(
							'class' => 'button compact icon-card'
						)
					); 
					?>
					<?php 
					echo $this->Html->link('Incidencia',
						array(
							'controller' => 'clientes',
							'action' => 'incidencia',
							$empresa['Empresa']['id']
						),
						array(
							'class' => 'button compact icon-drawer'
						)
					); 
					?>
					<?php 
					echo $this->Html->link('Eliminar', 
						array(
							'controller' => 'empresas',
							'action' => 'delete',
							$empresa['Empresa']['id']
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