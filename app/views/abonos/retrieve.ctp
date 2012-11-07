<head>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php 	echo $this->Html->script('src/views/creditos/js/jquery-1.7.2.min');
			echo $this->Html->script('src/views/creditos/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('src/views/clientes/incidencia');
		?>
</head>
<div id="menu">
<table>
<tr>
<td><?php echo $this->Html->link('Clientes', array('controller' => 'users', 'action' => 'sesion',1)); ?>
</td>	
<td><?php echo $this->Html->link('Empresas', array('controller' => 'users', 'action' => 'sesion',2)); ?>
</td>
<td><?php echo $this->Html->link('Reportes', array('controller' => 'empresas', 'action' => 'reportes')); ?>
</td>
<td><?php echo $this->Html->link('Pagos', array('controller' => 'abonos', 'action' => 'elegir_empresa')); ?>
</td>
<td><?php echo $this->Html->link('Finalizar sesión', array('controller'=>'users','action' => 'logout'));?>
</td>
</tr>
</table>
</div>
<?php 
App::import('Vendor', 'format');
$format = new format(); 
?>
<table>
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
	<?php echo $this->Form->create('Abono', array('action' => 'add')); ?>
		<div style = "width: 25%">
		<?php echo $this->Form->input('Abono.0.fecha_abono', array('class' => 'calendar', 'label' => 'Fecha del deposito')); ?>
		</div>
		<br>
		
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
			<?php echo $this->Form->input('Abono.' . $key . '.pago_id', array('type' => 'hidden', 'value' => $pago['Pago']['id'])); ?>			<?php echo $this->Form->input('Abono.' . $key . '.cliente_id', array('type' => 'hidden', 'value' => $pago['Cliente']['id'])); ?>
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
			<td><?php echo $this->Form->input('Abono.' . $key . '.deposito', array('label' => false)); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
	<?php echo $this->Form->end('Pagar'); ?>