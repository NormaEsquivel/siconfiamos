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
<br>
<?php $total=0;?>
<?php 
	$total=0;
	$total_empresa=0;
	$c=0;  
?>
<?php echo $this->Form->create('Empresa',array('action'=>'creditosmensual')); ?>
<fieldset>
	<legend>Elija el intervalo de fechas:</legend>
	<?php echo $this->Form->input('fecha_inicio', array(
														'label'=>'Fecha de Inicio:',
														'class' => 'calendar',
														'dateFormat'=>'MY',
														'minYear'=>date('Y')-5,
														'maxYear'=>date('Y')+5
														)); ?>
	<?php echo $this->Form->input('fecha_final', array(
													'label'=>'Fecha Final:',
													'class' => 'calendar',
													'dateFormat'=>'MY',
													'minYear'=>date('Y')-5,
													'maxYear'=>date('Y')+5
													)); ?>
	<?php echo $this->Form->end('Calcular'); ?>
</fieldset>
<h2>Reporte Mensual de Créditos Nuevos</h2>
<?php echo $this->Html->link('Histórico de Créditos Colocados',array('action'=>'creditoshistorico')); ?>
<br><br>
<table>
	<tr>
		<th>#</th>
		<th>Empresa</th>
		<th># (Empresa)</th>
		<th>Nombre</th>
		<th>Fecha</th>
		<th>Tasa Anual</th>
		<th>Periodo Cuotas</th>
		<th>Tiempo en Meses</th>
		<th>Monto</th>
	</tr>
	<?php
		$j = 1; 
		foreach($info['Empresa'] as $empresa):
		$i = 1;
		$total_empresa = 0; ?>
		<tr>
			<td> </td>
			<td><?php echo $empresa['nombre_empresa'];?></td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
		<?php if(isset($empresa['Cliente'])):
				foreach($empresa['Cliente'] as $cliente):
					$prestamo=number_format($cliente['Credito']['prestamo'],2);
					$total=$total+$cliente['Credito']['prestamo'];
					switch($cliente['Credito']['periodo_cuotas']){
						case 'diario':
									$divisor=30;
								break;
								case 'semanal':
									$divisor=4;
								break;
								case 'quincenal':
									$divisor=2;
								break;
								case 'mensual':
									$divisor=1;
								break;
					};
					$total_empresa = $total_empresa + round($cliente['Credito']['prestamo'], 2)
					?>
		<tr>
			<td><?php echo $j++; ?></td>
			<td> </td>
			<td><?php echo $i++; ?></td>
			<td><?php echo $cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno']; ?></td>
			<td><?php echo $cliente['Credito']['fecha'];?></td>
			<td><?php echo $cliente['Credito']['tasa_interes'].'%';?></td>
			<td><?php echo $cliente['Credito']['periodo_cuotas'];?></td>
			<td><?php echo $cliente['Credito']['cuotas']/$divisor;?></td>
			<td><?php echo '$'.$prestamo;?></td>
			
		</tr>
				<?php endforeach;?>
			<?php endif; ?>
		<tr>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td>Total <?php echo $empresa['nombre_empresa'];?>: </td>
			<td><?php echo '$'. number_format($total_empresa, 2);?></td>
			
		</tr>	
			
		<?php endforeach;?>
		<tr>
			<td>Total:</td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td><?php echo '$'.number_format($total,2); ?> </td>
		</tr>
</table>
<br>
<?php echo $this->Html->link($this->Html->image('icon_excel.png'), array('controller' => 'empresas', 'action' => 'exportar'), array('escape' => false, 'title' =>'Exportar')); ?>


