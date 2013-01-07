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
$fourthElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass', 'fourthElementClass'));
echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js', array('inline' => false) ); 
echo $this->Html->script('src/views/clientes/creditos_detalle.js', array(
	'inline' => false
)); 
?>
<div class= "twelve-columns">
<h3 class = "thin"><?php echo $title; ?><h3>
</div>
<table class="simple-table responsive-table responsive-table-on" id = "sorting-example2">
	<thead>
		<tr>
			<th scope="col">Empresa</th>
			<th></th>
			<th></th>
			<th scope="col">Capital</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th scope="col">Intereses</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>IVA</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th scope="col">Cliente</th>
			<th scope="col">Saldo inicial</th>
			<th scope="col">Prestamo</th>
			<th scope="col">Pagos</th>
			<th scope="col">Saldo</th>
			<th scope="col"></th>
			<th scope="col">Saldo inicial</th>
			<th scope="col">Prestamo</th>
			<th scope="col">Pagos</th>
			<th scope="col">Saldo</th>
			<th scope="col"></th>
			<th scope="col">Saldo inicial</th>
			<th scope="col">Prestamo</th>
			<th scope="col">Pagos</th>
			<th scope="col">Saldo</th>
			<th scope="col"></th>
			<th scope="col">Saldo</th>
		</tr>
	</thead>
<tbody>
			<?php
			$totsaldoini=0;
			$totalsaldoini_interes=0;
			$totalsaldoini_iva=0;
			$totalprestamo=0;
			$totalpagos=0;
			$totalsaldo=0;
			$totalpagos_intereses=0;
			$totalpagos_iva=0;
			$totalprestamo_intereses=0;
			$totalprestamo_iva=0;
			$totalSaldo_interes=0;
			$totalSaldo_iva=0;
			$totalSaldoTotal=0;
			if($total!=null):
		foreach($total as $key => $totals):
			?>
		<tr>
			<td><strong><?php echo $key; ?></strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
			foreach($totals as $key2 => $totales):
		?>
		
		<?php
			$totsaldoini=$totsaldoini+$totales['saldoinicial'];
			$totalsaldoini_interes=$totalsaldoini_interes + $totales['Saldo_inicial_interes'];
			$totalsaldoini_iva=$totalsaldoini_iva + $totales['Saldo_inicial_iva'];
			$totalprestamo=$totalprestamo+$totales['Prestamo'];
			$totalpagos=$totalpagos+$totales['pagos'];
			$totalsaldo=$totalsaldo+$totales['saldo'];
			$totalpagos_intereses=$totalpagos_intereses+$totales['interes'];
			$totalpagos_iva=$totalpagos_iva+$totales['iva'];
			$totalprestamo_intereses=$totalprestamo_intereses+$totales['Prestamo_interes'];
			$totalprestamo_iva=$totalprestamo_iva+$totales['Prestamo_iva'];
			$totalSaldo_interes=$totalSaldo_interes+$totales['Saldo_interes'];
			$totalSaldo_iva=$totalSaldo_iva+$totales['Saldo_iva'];
			$totalSaldoTotal=$totalSaldoTotal+$totales['Saldototal'];
			?>
			
		<tr>
			<td></td>
			<td><?php echo $key2 ?></td>
			<td>$<?php echo round($totales['saldoinicial'],2);?></td>
			<td>$<?php echo round($totales['Prestamo'],2);?></td>
			<td>$<?php echo round($totales['pagos'],2);?></td>
			<td>$<?php echo round($totales['saldo'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldo_inicial_interes'],2);?></td>
			<td>$<?php echo round($totales['Prestamo_interes'],2);?></td>
			<td>$<?php echo round($totales['interes'],2);?></td>
			<td>$<?php echo round($totales['Saldo_interes'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldo_inicial_iva'])?></td>
			<td>$<?php echo round($totales['Prestamo_iva'],2);?></td>
			<td>$<?php echo round($totales['iva'],2);?></td>
			<td>$<?php echo round($totales['Saldo_iva'],2);?></td>
			<td><?php?></td>
			<td>$<?php echo round($totales['Saldototal'],2);?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td></td>
			<td><strong>$<?php echo round($totsaldoini,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos,2);?></strong></td>
			<td><strong>$<?php echo round($totalsaldo,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalsaldoini_interes,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo_intereses,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos_intereses,2);?></strong></td>
			<td><strong>$<?php echo round($totalSaldo_interes,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalsaldoini_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalprestamo_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalpagos_iva,2);?></strong></td>
			<td><strong>$<?php echo round($totalSaldo_iva,2);?></strong></td>
			<td></td>
			<td><strong>$<?php echo round($totalSaldoTotal,2);?></strong></td>
		</tr>
		<?php	
			endforeach;
			endif;
		?>
</tbody>
</table>
<div class= "twelve-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Credito', array(
				'url' => array(
					'controller' => 'creditos',
					'action' => 'creditos_detalle'
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