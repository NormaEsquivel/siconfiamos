<?php 
App::import('Vendor', 'format');
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
$format = new format();
echo $this->Html->script('src/views/abonos/retrieve.js', array(
	'inline' => false));
$firstElementClass = '';
$secondElementClass = '';
$thirdElementClass = 'current';
$fourthElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass', 'fourthElementClass'));

?>
<?php echo $this->Form->create('Abono', array('action' => 'add')); ?>
	<?php 
	echo $this->Form->input('Abono.0.fecha_abono', array(
		'div' => false,
		'before' => '<p class = "inline-label button-height">',
		'after' => '</p>',
		'class' => 'input small-margin right datepicker',
		'label' => array(
			'class' => 'label',
			'text' => 'Fecha de depósito'
		)
	)); 
	?>
	<table class = "simple-table responsive-table responsive-table-on" id = "sorting-example2">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>#</th>
				<th>Fecha</th>
				<th>Saldo</th>
				<th>Capital</th>
				<th>Interés</th>
				<th>Iva</th>
				<th>Depósito</th>
			</tr>
		</thead>
		<tbody>			
		<?php foreach($pagos as $key => $pago): ?>
			<?php
				$saldo_redondeado = round($pago['Pago']['pago'], 2) - round($pago['Pago']['saldo_pago_actual'], 2);
				if($pago['Pago']['pago'] > $saldo_redondeado){
					$intereses_redondeados = round($pago['Pago']['intereses'], 2);
					if($saldo_redondeado >= $intereses_redondeados){
						$pago['Pago']['intereses'] = 0;
						$saldo_redondeado = $saldo_redondeado - $intereses_redondeados;
						$iva_redondeado = round($pago['Pago']['iva_intereses'], 2);
						if($saldo_redondeado >= $iva_redondeado){
							$pago['Pago']['iva_intereses'] = 0;
							$saldo_redondeado = $saldo_redondeado - $iva_redondeado;
							$capital_redondeado = round($pago['Pago']['pago_capital'], 2);
							if($saldo_redondeado >= $capital_redondeado){
								$pago['Pago']['pago_capital'] = $saldo_redondeado - $capital_redondeado;
							}else{
								$pago['Pago']['pago_capital'] = $capital_redondeado - $saldo_redondeado;
							}
						}else{
							$pago['Pago']['iva_intereses'] = $iva_redondeado - $saldo_redondeado;
						}
					}else{
						$pago['Pago']['intereses'] = $intereses_redondeados - $saldo_redondeado;
					}
				}
			?>
			<tr>
				<?php echo $this->Form->input('Abono.' . $key . '.tipo_calculo', array('type' => 'hidden', 'value' => $pago['Credito']['tipo_calculo'])); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.saldo_credito', array('type' => 'hidden', 'value' => round($pago['Credito']['saldo'], 2))); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.credito_id', array('type' => 'hidden', 'value' => $pago['Pago']['credito_id'])); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.pago_id', array('type' => 'hidden', 'value' => $pago['Pago']['id'])); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.cliente_id', array('type' => 'hidden', 'value' => $pago['Cliente']['id'])); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.pago_regular', array('type' => 'hidden', 'value' => round($pago['Pago']['pago'], 2))); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.monto_pago', array('type' => 'hidden', 'value' => round($pago['Pago']['saldo_pago'], 2))); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.empresa_id', array('type' => 'hidden', 'value' => $pago['Cliente']['empresa_id'])); ?>
				<?php echo $this->Form->input('Abono.' . $key . '.fecha', array('type' => 'hidden', 'value' => $pago['Pago']['fecha_bien'])); ?>
				<td><?php echo $pago['Cliente']['nombre']; ?></td>
				<td><?php echo $pago['Pago']['numero_pago']; ?></td>
				<td><?php echo $format->fechapago($pago['Pago']['fecha']); ?></td>
				<td>$<?php echo number_format($pago['Pago']['saldo_total'], 2); ?></td>
				<td>$<?php echo number_format($pago['Pago']['pago_capital'], 2); ?></td>
				<td>$<?php echo number_format($pago['Pago']['intereses'], 2); ?></td>
				<td>$<?php echo number_format($pago['Pago']['iva_intereses'], 2); ?></td>
				<td><?php echo $this->Form->input('Abono.' . $key . '.deposito', array('div' => false, 'label' => false, 'class' => 'input small-margin-right')); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan = "8" align = "right">
				<?php 
				echo $this->Form->end(array(
					'class' => 'button blue-gradient glossy',
					'id' => 'submit-button',
					'label' => 'Seleccionar'
					)); 
				?>
			</td>
			</tr>
		</tfoot>
	</table>