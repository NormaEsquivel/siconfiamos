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
$firstElementClass = 'current';
$secondElementClass = '';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
echo $this->Html->script('src/portal/developr.accordions.js', array(
	'inline' => false
));

?>

<h3 class = "thin underline">Historial de Crédito de <?php echo $creditos[0]['Cliente']['full_name']; ?></h3>

<table class="simple-table responsive-table" id="sorting-example2">

	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Fecha</th>
			<th scope="col">Monto</th>
			<th scope="col">Número de Cuotas</th>
			<th scope="col">Periodo Cuotas</th>
			<th scope="col">Tipo de Cálculo</th>
			<th scope="col">Estado</th>
			<th scope="col">Acciones</th>
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
			<td></td>
			<td></td>
		</tr>
	</tfoot>

	<tbody>
		<?php foreach($creditos as $credito): ?>
			<tr>
				<td scope="row"><?php echo $credito['Credito']['id']; ?></td>
				<td scope="row"><?php echo $credito['Credito']['fecha_calculo']; ?></td>
				<td scope="row">$<?php echo number_format($credito['Credito']['prestamo'], 2); ?></td>
				<td scope="row"><?php echo $credito['Credito']['cuotas']; ?></td>
				<td scope="row"><?php echo ucfirst($credito['Credito']['periodo_cuotas']); ?></td>
				<td scope="row"><?php echo ucfirst($credito['Credito']['tipo_calculo']); ?></td>
				<td scope="row"><?php echo ucfirst($credito['Credito']['estado']); ?></td>
				<td scope="row">
					<?php 
					echo $this->Html->link('Ver',
						array(
							'controller' => 'creditos',
							'action' => 'view_credit',
							$credito['Credito']['id']
						),
						array(
							'class' => 'button compact icon-card'
						)
					); 
					?>
				</td>				
			</tr>
		<?php endforeach; ?>
	</tbody>

</table>