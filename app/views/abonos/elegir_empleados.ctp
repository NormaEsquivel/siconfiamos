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
echo $this->Html->script('src/views/abonos/elegir_empleados.js', array(
	'inline' => false));
$firstElementClass = '';
$secondElementClass = '';
$thirdElementClass = 'current';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));

?>

<div class = "nine-columns">
	<h3 class = "thin underline">Elija los clientes a los que desea aplicarles un pago</h3>
	<table class = "simple-table responsive-table responsive-table-on" id = "sorting-example2">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Pago</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 0;
			echo $this->Form->create('Abono', array('action' => 'retrieve')); ?>
			<?php foreach($clientes as $key => $cliente): ?>
				<?php if($cliente['Cliente']['credito_activo']): ?>
				<tr>
					<td><?php echo $cliente['Cliente']['full_name']; ?></td>
					<td>
					<?php 
						echo $this->Form->input('Abono.' . $i . '.addPay', array(
							'type' => 'checkbox',
							'label' => false,
							'div' => false
						));
					?> 
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
					</td>
				</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan = "2" align = "right">
				<?php 
				echo $this->Form->end(array(
					'class' => 'button blue-gradient glossy',
					'id' => 'submit-button',
					'label' => 'Seleccionar'
					)); 
				?>
			</td>
			</tr>
		</tfoot>
	</table>
</div>
<div class= "five-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
		<?php
		echo $this->Form->create('Abono', array(
			'url' => array(
				'action' => 'elegir_empleados', $id
			)
		));
		echo $this->Form->input('periodo', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'type' => 'select',
			'options' => array(
				'semanal' => 'Semanal',
				'quincenal' => 'Quincenal',
				'mensual' => 'Mensual'
			),
			'label' => array(
					'class' => 'label',
					'text' => 'Período'
			),
			'empty' => '(Elija el período de pago)',
			'class' => 'select'
		));
		echo $this->Form->end(array(
			'class' => 'button blue-gradient glossy',
			'id' => 'submit-button',
			'label' => 'Buscar'
		));
		?>
		</div>
	</details>
</div>

	
