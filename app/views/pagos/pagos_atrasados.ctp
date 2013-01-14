<?php
$menu_elements = array(
	'element' => array(
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
echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js', array('inline' => false) ); 
echo $this->Html->script('src/views/pagos/pagos_atrasados.js', array(
	'inline' => false
)); 
?>

<div class= "three-columns">
		<h3 class="thin"><?php echo $title;?><h3>
</div>

<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<thead>
		<tr>
			<th scope="col">Empresa</th>
			<th scope="col">Empleado</th>
			<th scope="col">Adeudo</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		foreach($arreglo as $key => $arreglo):
		?>
	<tr>	
		<td><?php echo $arreglo['Empresa']; ?></td>
		<td><?php echo $key; ?></td>			
		<td><?php echo round($arreglo['Adeudo'],2); ?></td>
	</tr>
		<?php
		endforeach;
		?>
	</tbody>

</table>

<div class= "six-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Pago', array(
				'url' => array(
					'controller' => 'pagos',
					'action' => 'pagos_atrasados'
				)
			));
			?>
			<!--<?php 
			echo $this->Form->input('fecha_inicio', array(
				'div' => false,
				'before' => '<p class = "inline-label button-height">',
				'after' => '</p>',
				'label' => array(
					'class' => 'label',
					'text' => 'Fecha de inicio'
				),
				'type' => 'text',
				'class' => 'input small-margin-right datepicker'

			));
			?>
			<?php 
			echo $this->Form->input('fecha_final', array(
				'div' => false,
				'before' => '<p class = "inline-label button-height">',
				'after' => '</p>',
				'label' => array(
					'class' => 'label',
					'text' => 'Fecha final'
				),
				'type' => 'text',
				'class' => 'input small-margin-right datepicker'

			));
			?>
			<?php 
			echo $this->Form->end(array(
				'class' => 'button blue-gradient glossy',
				'id' => 'submit-button',
				'label' => 'Buscar'
			));
			?>-->
		</div>
	</details>
</div>