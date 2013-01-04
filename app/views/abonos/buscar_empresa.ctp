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
echo $this->Html->script('src/views/abonos/buscar_empresa.js', array(
	'inline' => false
)); 

?>

<div class="five-columns">
	<h3 class="thin"><?php echo $title; ?></h3>
</div>
<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<thead>
		<tr>
			<th scope="col">Empresa</th>
			<th scope="col">Capital</th>
			<th scope="col">Interes</th>
			<th scope="col">IVA</th>
			<th scope="col">Total</th>
		</tr>
	</thead>
<tbody>
	<?php
$totalcap=0;
$totalint=0;
$totaliva=0;
$totaltot=0;
if($total!=null):	
foreach($total as $key => $nomempresa):
foreach($empresas as $empresa)
?>
<tr>
	<td><strong><?php echo $key; ?></strong></td>
	<td>$<?php echo $nomempresa['Capital'];?></td>
	<td>$<?php echo $nomempresa['Interes'];?></td>
	<td>$<?php echo $nomempresa['Iva'];?></td>
	<td>$<?php echo $nomempresa['t'];?></td>
</tr>
<?php
$totaltot=$totaltot + $nomempresa['Capital'] + $nomempresa['Interes'] + $nomempresa['Iva'];
$totalcap=$totalcap + $nomempresa['Capital'];
$totalint=$totalint + $nomempresa['Interes'];
$totaliva=$totaliva + $nomempresa['Iva'];

endforeach;
?>
<tr>
	<td><strong>TOTAL:</strong></td>
	<td><strong>$<?php echo $totalcap; ?></strong></td>
	<td><strong>$<?php echo $totalint; ?></strong></td>
	<td><strong>$<?php echo $totaliva; ?></strong></td>
	<td><strong>$<?php echo $totaltot; ?> </strong></td>
</tr>
<?php endif;?>
</tbody>
</table>
<div class= "five-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Abono', array(
				'url' => array(
					'controller' => 'abonos',
					'action' => 'buscar_empresa'
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