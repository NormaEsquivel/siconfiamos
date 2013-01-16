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

<div class= "six-columns">
		<h3 class="thin"> <?php echo $title;?> <h3>
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
		<?php		foreach($arreglo as $Key => $arreglo1):
		?>
	<tr>	
		<td><strong><?php echo $Key; ?></strong></td>
		<td></td>			
		<td></td>
	</tr>
		<?php
			foreach($arreglo1 as $Key2 => $arreglo2):
		?>
	<tr>	
		<td></td>
		<td><?php echo $Key2; ?></td>			
		<td><?php echo round($arreglo2['Adeudo'],2); ?></td>
	</tr>
		<?php
			endforeach;
		endforeach;
		?>
	</tbody>
</table>


<div class="with-padding">
	<?php 
	echo $this->Form->create('Pago', array(
		'url' => array(
			'controller' => 'pagos',
			'action' => 'pagos_atrasados'
		)
	));
	?>
</div>