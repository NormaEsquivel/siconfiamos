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

<h2>Reporte Histórico de Créditos Nuevos</h2>
<br>

<?php
$total=0;
$c=0;

echo $this->Html->link('Créditos Colocados Mensual',array('action'=>'creditosmensual')); ?>
<br><br>
<table>
	<tr>
		<th>Empresa</th>
		<th>#</th>
		<th>Nombre</th>
		<th>Fecha</th>
		<th>Tasa Anual</th>
		<th>Periodo Cuotas</th>
		<th>Tiempo en Meses</th>
		<th>Monto</th>
	</tr>
	<?php foreach($info['Empresa'] as $empresa): ?>
		<tr>
			<td><?php $total_empresa=0;  
			echo $empresa['nombre_empresa'];?></td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
			<?php foreach($empresa['Cliente'] as $cliente):
						$c=$c+1;
						$prestamo=number_format($cliente['Credito']['prestamo'],2);
						$total=$total+$cliente['Credito']['prestamo'];
						$total_empresa=$total_empresa+$cliente['Credito']['prestamo'];
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
						}?>
					<tr>
						<td> </td>
						<td><?php echo $c;?></td>
						<td><?php echo $cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno']; ?></td>
						<td><?php echo $cliente['Credito']['fecha'];?></td>
						<td><?php echo $cliente['Credito']['tasa_interes'].'%';?></td>
						<td><?php echo $cliente['Credito']['periodo_cuotas'];?></td>
						<td><?php echo $cliente['Credito']['cuotas']/$divisor;?></td>
						<td><?php echo '$'.$prestamo;?></td>
						
					</tr>
		
			<?php endforeach;?>
			<tr>
				<td>Total de la empresa:</td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td><?php echo '$'.number_format($total_empresa,2); ?> </td>
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
			<td><?php echo '$'.number_format($total,2); ?> </td>
		</tr>
</table>
<br>
<?php echo $this->Html->link($this->Html->image('icon_excel.png'), array('controller' => 'empresas', 'action' => 'exportarhistorico'), array('escape' => false, 'title' =>'Exportar')); ?>