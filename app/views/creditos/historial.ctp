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
<h2>Historial Crediticio de <?php echo $creditos[0]['Cliente']['nombre'].' '.$creditos[0]['Cliente']['apellido_paterno'].' '.$creditos[0]['Cliente']['apellido_materno']; ?></h2>
<br>
<?php echo $this->Html->link('Credito actual de '.$creditos[0]['Cliente']['nombre'].' '.$creditos[0]['Cliente']['apellido_paterno'].' '.$creditos[0]['Cliente']['apellido_materno'],array('action'=>'view',$creditos[0]['Cliente']['id'])); ?>
<br>
<br>
<table>
<thead>
	<tr>
	<th>Numero de Crédito</th>
	<th>Fecha</th>
	<th>Monto</th>
	<th>Numero de Cuotas</th>
	<th>Periodo Cuotas</th>
	<th>Estado</th>
	</tr>
</thead>
<tbody>
<?php $meses=array(0,'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'); 
foreach($creditos as $credito):
	$fecha=explode('-',$credito['Credito']['fecha_calculo']); ?>
	<tr>
	<td><?php echo $credito['Credito']['id']; ?></td>
	<td><?php echo $fecha[2].' de '.$meses[$fecha[1][0]*10+$fecha[1][1]].' de '.$fecha[0]; ?></td>
	<td><?php echo '$'.number_format($credito['Credito']['prestamo'],2); ?></td>
	<td><?php echo $credito['Credito']['cuotas']; ?></td>
	<td><?php echo $credito['Credito']['periodo_cuotas']; ?></td>
	<td><?php echo $credito['Credito']['estado']; ?></td>
	<td><?php echo $html->link('Pagos', array('controller' => 'pagos', 'action' => 'imprimirpdf', $credito['Credito']['id'])); ?></td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>