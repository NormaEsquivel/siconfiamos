<?php 
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Imprimir Reporte', 
			array(
				'controller' => 'abonos',
				'action' => 'imprimir'
			)
		)
	),
	'element1' => array(
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
echo $this->Html->script('src/views/abonos/saldo_creditos.js', array(
	'inline' => false
)); 

?>
<div class= "twelve-columns">
<h3 class = "thin"><?php echo $title; ?><h3>
</div>
<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<head>
		<tr>
			<th scope="col">Empresa</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th scope="col">Cliente</th>
			<th scope="col">Numero de pagos</th>
			<th scope="col">Prestamo</th>
		</tr>
	</head>
		<tbody>
		<?php
		foreach($arreglo as $key => $arreglo1):
		?>
		<tr>
			<td><strong><?php echo $key ?></strong></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
			foreach($arreglo1 as $key2 => $arreglo2):
		?>
		<tr>
			<td></td>
			<td><?php echo $key2 ?></td>
			<td><?php echo $arreglo2['NumerodePago']?></td>
			<td><?php echo $arreglo2['PrestamoCliente']?></td>
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
			'action' => 'creditos_cortados'
		)
	));
	?>
</div>