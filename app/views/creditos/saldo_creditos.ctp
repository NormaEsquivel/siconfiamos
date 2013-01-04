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
			<th>Empresa</th>
			<th>Saldo inicial</th>
			<th>prestamo</th>
			<th>pagos</th>
			<th>saldo</th>
			<th></th>
			<th>Saldo inicial</th>
			<th>prestamo</th>
			<th>pagos</th>
			<th>saldo</th>
			<th></th>
			<th>Saldo inicial</th>
			<th>prestamo</th>
			<th>pagos</th>
			<th>saldo</th>
			<th></th>
			<th>Saldo</th>
		</tr>
	</head>
	<tbody>
		<?php
		$totalsaldini=0;
		$totalsaldini_intereses=0;
		$totalsaldini_iva=0;
		$totalpres=0;
		$totalpagos_cap=0;
		$totalsaldo=0;
		$totalpagos_int=0;
		$totalpagos_iva=0;
		$totalpres_int=0;
		$totalpres_iva=0;
		$totalsaldointeres=0;
		$totalsaldoiva=0;
		$totalSaldototal=0;
		if($t != null):
		foreach($t as $key => $total):
		?>
		<tr>
			<td><?php echo $key ?></td>
			<td>$<?php echo round($total['Saldo_inicial'],2); ?></td>
			<td>$<?php echo round($total['Prestamo'],2); ?></td>
			<td>$<?php echo round($total['Pago'],2); ?></td>
			<td>$<?php echo round($total['Saldo'],2); ?></td>
			<td><?php?></td>
			<td>$<?php echo round($total['Saldo_inicial_intereses'],2); ?></td>
			<td>$<?php echo round($total['Prestamo_inte'],2); ?></td>
			<td>$<?php echo round($total['Interes'],2); ?></td>
			<td>$<?php echo round($total['saldointeres'])?></td>
			<td><?php ?></td>
			<td>$<?php echo round($total['Saldo_inicial_iva'],2);?></td>
			<td>$<?php echo round($total['Prestamo_iva']); ?></td>
			<td>$<?php echo round($total['Iva'],2); ?></td>
			<td>$<?php echo round($total['saldoiva'],2);?></td>
			<td><?php ?></td>
			<td>$<?php echo round($total['Saldototal'],2);?></td>
		</tr>
		<?php 
		$totalsaldini=$totalsaldini + round($total['Saldo_inicial'],2);
		$totalsaldini_intereses=$totalsaldini_intereses + round($total['Saldo_inicial_intereses'],2);
		$totalsaldini_iva=$totalsaldini_iva + round($total['Saldo_inicial_iva'],2);
		$totalpres=$totalpres + round($total['Prestamo'],2);
		$totalpagos_cap=$totalpagos_cap + round($total['Pago'],2);
		$totalsaldo=$totalsaldo + round($total['Saldo'],2);
		$totalpagos_int=$totalpagos_int + round($total['Interes'],2);
		$totalpagos_iva=$totalpagos_iva + round($total['Iva'],2);
		$totalpres_iva=$totalpres_iva+round($total['Prestamo_iva'],2);
		$totalpres_int=$totalpres_int+round($total['Prestamo_inte'],2);
		$totalsaldointeres=$totalsaldointeres + round($total['saldointeres'],2);
		$totalsaldoiva=$totalsaldoiva + round($total['saldoiva'],2);
		$totalSaldototal=$totalSaldototal+round($total['Saldototal'],2);
		endforeach;
	endif;
		?>
		
		<tr>
			<td><strong>Total</strong></td>
			<td><strong>$<?php echo $totalsaldini;?></strong></td>
			<td><strong>$<?php echo $totalpres; ?></strong></td>
			<td><strong>$<?php echo $totalpagos_cap;?></strong></td>
			<td><strong>$<?php echo $totalsaldo; ?></strong></td>
			<td><?php?></td>
			<td><strong>$<?php echo $totalsaldini_intereses; ?></strong></td>
			<td><strong>$<?php echo $totalpres_int; ?></strong></td>
			<td><strong>$<?php echo $totalpagos_int;?></strong></td>
			<td><strong>$<?php echo $totalsaldointeres; ?></strong></td>
			<td><?php?></td>
			<td><strong>$<?php echo $totalsaldini_iva; ?></strong></td>
			<td><strong>$<?php echo $totalpres_iva; ?></strong></td>
			<td><strong>$<?php echo $totalpagos_iva;?></strong></td>
			<td><strong>$<?php echo $totalsaldoiva; ?></strong></td>
			<td><?php?></td>
			<td><strong>$<?php echo $totalSaldototal;?></strong></td>
		</tr>
	</tbody>
</table>
<div class= "five-columns">
	<details class="details margin-bottom">
		<summary role="button" aria-expanded="false">Búsqueda</summary>
		<div class="with-padding">
			<?php 
			echo $this->Form->create('Credito', array(
				'url' => array(
					'controller' => 'creditos',
					'action' => 'saldo_creditos'
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