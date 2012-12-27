<?php
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Imprimir Cotización', 
			array(
				'controller' => 'creditos',
				'action' => 'pdfcotizar'
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
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
?>

<h3 class = "thin underline">Cotización de Crédito</h3>

<div class="standard-tabs margin-bottom" id="add-tabs">

	<ul class="tabs">
		<li class="active"><a href="#tab-1">Información del Crédito</a></li>
		<li><a href="#tab-2">Pagos</a></li>
	</ul>

	<div class="tabs-content">

		<div id="tab-1" class="with-padding">
			<dl class = "definition inline">
				<dt>Nombre del Cliente:</dt> <dd><?php echo ucfirst($credito['Credito']['nombre_cliente']); ?></dd>
				<dt>Fecha:</dt> <dd><?php echo $credito['Credito']['fecha_cotizacion']; ?></dd>
				<dt>Tasa de interés:</dt> <dd><?php echo $credito['Credito']['tasa_interes']; ?>%</dd>
				<dt>Número de cuotas:</dt> <dd><?php echo $credito['Credito']['cuotas']; ?></dd>
				<dt>Período de cuotas:</dt> <dd><?php echo ucfirst($credito['Credito']['periodo_cuotas']); ?></dd>
				<dt>Préstamo:</dt> <dd>$<?php echo number_format($credito['Credito']['prestamo'], 2); ?></dd>
				<dt>Fecha de cotizacion:</dt> <dd><?php echo $credito['Credito']['fecha_cotizacion']; ?></dd>
				<dt>Tipo de cálculo:</dt> <dd><?php echo ucfirst($credito['Credito']['tipo_calculo']); ?></dd>
			</dl>
		</div>

		<div id="tab-2" class="with-padding">

			<table class="simple-table responsive-table" id="sorting-example2">

				<thead>
					<tr>
						<th scope="col">Fecha</th>
						<th scope="col">Número de pago:</th>
						<th scope="col">Capital:</th>
						<th scope="col">Intereses:</th>
						<th scope="col">Iva:</th>
						<th scope="col">Pago:</th>
						<th scope="col">Saldo Insoluto:</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>

				<tbody>
					<?php foreach($arreglo['Pago'] as $pago): ?>
						<tr>
							<td scope="row"><?php echo $pago['fecha']; ?></td>
							<td scope="row"><?php echo $pago['numero_pago']; ?></td>
							<td scope="row">$<?php echo number_format($pago['pago_capital'], 2); ?></td>
							<td scope="row">$<?php echo number_format($pago['intereses'], 2); ?></td>
							<td scope="row">$<?php echo number_format($pago['iva_intereses'], 2); ?></td>
							<td scope="row">$<?php echo number_format($pago['pago'], 2); ?></td>
							<td scope="row">$<?php echo number_format($pago['saldo_insoluto'], 2); ?></td>							
						</tr>
					<?php endforeach; ?>
				</tbody>

			</table>

		</div>

	</div>

</div>