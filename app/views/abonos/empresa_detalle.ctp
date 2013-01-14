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
echo $this->Html->script('src/views/abonos/empresa_detalle.js', array(
	'inline' => false
)); 

?>

<div class= "twelve-columns">
	<h3 class="thin"><?php echo $title;?><h3>
</div>

<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<thead>
		<tr>
			<th scope="col">Empresa</th>
			<th scope="col">Empleado</th>
			<th scope="col">Capital</th>
			<th scope="col">Interes</th>
			<th scope="col">Iva</th>
			<th scope="col">Total</th>
		</tr>
	</thead>
<tbody>
	<?php 
$totalcap=0;
$totalint=0;
$totaliva=0;
$totaltot=0;
if($arreglo != null):
foreach($arreglo as $key => $detalle):
?>
	<tr>	
		<td><?php echo $key; ?></td>
		<td></td>			
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<?php
foreach($detalle as $key2=> $totals):
?>

<?php
$totaltot=$totaltot + round($totals['Capital'],2) + $totals['Interes'] + round($totals['Iva'],2);
$totalcap=$totalcap + round($totals['Capital'],2);
$totalint=$totalint + round($totals['Interes'],2);
$totaliva=$totaliva + round($totals['Iva'],2);
?>
<tr>	
	<td></td>
	<td><?php echo $key2;?></td>			
	<td>$<?php echo round($totals['Capital'],2);?></td>
	<td>$<?php echo round($totals['Interes'],2);?></td>
	<td>$<?php echo round($totals['Iva'],2);?></td>
	<td>$<?php echo round($totals['t'],2);?></td>
</tr>
<?php endforeach?>
<tr>
	<td><?php?></td>
	<td><strong>Total</strong></td>
	<td><strong>$<?php echo $totalcap; ?></strong></td>
	<td><strong>$<?php echo $totalint; ?></strong></td>
	<td><strong>$<?php echo $totaliva; ?></strong></td>
	<td><strong>$<?php echo round($totaltot,2); ?></strong></td>
</tr>

<?php	
endforeach;
endif; ?>

</tbody>
</table>

<div class= "six-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Abono', array(
				'url' => array(
					'controller' => 'abonos',
					'action' => 'empresa_detalle'
				)
			));
			?>
			<?php 
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
			?>
		</div>
	</details>
</div>