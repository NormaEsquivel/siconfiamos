<?php 
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Imprimir Incidencia', 
			array(
				'controller' => 'incidencias',
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
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js', array('inline' => false) ); 
echo $this->Html->script('src/views/clientes/incidencia.js', array(
	'inline' => false
)); 

?>
<div class= "nine-columns">
<h3 class = "thin"><?php echo $title; ?><h3>
</div>
<?php if(isset($pagos)): ?>
<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col" class = "align-center"># Cheque</th>
			<th scope="col">Nombre Cliente</th>
			<th scope="col">Fecha de emisión</th>
			<th scope="col" class = "align-center"># Pago</th>
			<th scope="col">Retención</th>
			<th scope="col">Capital</th>
			<th scope="col">Interés</th>
			<th scope="col">IVA</th>
			<th scope="col">Situación</th>
		</tr>
	</thead>
<tbody>
	<?php $i = 1;
	foreach($pagos as $key => $arreglo):
		foreach($arreglo as $llave => $pago):?>

		<tr>
			<td><?php echo $i++; ?></td>
			<td class = "align-center"><?php echo $pago['Credito']['cheque']; ?></td>
			<td><?php echo isset($clientes[$key]['Cliente']['division']) ? $clientes[$key]['Cliente']['full_name'].' (' . $clientes[$key]['Cliente']['division'] . ')' : $clientes[$key]['Cliente']['full_name']; ?></td>
			<td  class = "align-center"><?php echo date('d/m/Y', strtotime($pago['Pago']['fecha'])); ?></td>
			<td  class = "align-center"><?php echo $pago['Pago']['numero_pago'] ?></td>
			<td>$ <?php echo number_format($pago['Pago']['pago'],2); ?></td>
			<td>$ <?php echo number_format($pago['Pago']['pago_capital'],2); ?></td>
			<td>$ <?php echo number_format($pago['Pago']['intereses'],2); ?></td>
			<td>$ <?php echo number_format($pago['Pago']['iva_intereses'],2); ?></td>
			<td><?php echo $pago['Pago']['sitacion']; ?></td>
		</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td>Total:</td>
		<td>$ <?php echo number_format($total['Pago'],2); ?></td>
		<td>$ <?php echo number_format($total['Capital'],2); ?></td>
		<td>$ <?php echo number_format($total['Interes'],2); ?></td>
		<td>$ <?php echo number_format($total['Iva'],2); ?></td>
		<td> </td>
	</tr>
</tbody>
</table>
<?php endif; ?>
<div class= "five-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Cliente', array(
				'url' => array(
					'controller' => 'clientes',
					'action' => 'incidencia',
					$id
				),
				'id' => 'new-credit-form'
			));
			?>
			<?php 
			echo $this->Form->input('id', array(
				'type' => 'hidden',
				'value' => $id
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
				'empty' => '(Elija el período de pago)',
				'label' => array(
					'class' => 'label',
					'text' => 'Período'
				),
				'class' => 'select'

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