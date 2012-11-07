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
<h3>Información de Ingresos/Egresos</h3>
<br>
<?php echo $this->Html->link('Ver Cliente', array('controller' => 'clientes', 'action' => 'view', $ingreso['Ingreso']['cliente_id'])); ?>
<table>
	<tr><th>Ingresos</th>
		<th></th>
		<th>Egresos</th>
		<th></th>		
	</tr>
<tr>
 <td>Salario IMSS:</td><td><?php echo $ingreso['Ingreso']['salario_imss'];?></td>
 <td>Egreso IMSS:</td><td><?php echo $ingreso['Ingreso']['egresos_imss'];?></td></tr>
<tr>
<tr>
 <td>Salario Real:</td><td><?php echo $ingreso['Ingreso']['salario_real'];?></td>
 <td>Egreso Real:</td><td><?php echo $ingreso['Ingreso']['egresos_real'];?></td></tr>
<tr>
<tr>
 <td>Otros Ingresos:</td><td><?php echo $ingreso['Ingreso']['otros_ingresos'];?></td>
 <td>Otros Egresos:</td><td><?php echo $ingreso['Ingreso']['otros_egresos'];?></td></tr>
<tr>
<tr>
 <td>Total Ingresos:</td><td><?php echo $ingreso['Ingreso']['total_ingresos'];?></td>
 <td>Total Egresos:</td><td><?php echo $ingreso['Ingreso']['total_egresos'];?></td></tr>
<tr>
</table>

