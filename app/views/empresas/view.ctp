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
<h2>Información de la Empresa</h2>
<br>
<?php echo $this->Html->link('Editar', array('controller' => 'empresas', 'action' => 'edit', $empresa['Empresa']['id'])); ?>
<br>
<?php echo $this->Html->link('Ver Clientes', array('controller' => 'empresas', 'action' => 'cliente_view', $empresa['Empresa']['id'])); ?>
<table>
<tr>
<th>Nombre:</th><td><?php echo $empresa['Empresa']['nombre'];?></td></tr>
<tr><th>Dirección:</th><td><?php echo $empresa['Empresa']['direccion'];?></td></tr>
<tr><th>Ciudad:</th><td><?php echo $empresa['Empresa']['ciudad'];?></td></tr>
<tr><th>Estado:</th><td><?php echo $empresa['Empresa']['estado'];?></td></tr>
<tr><th>Telefono:</th><td><?php echo $empresa['Empresa']['telefono'];?></td></tr>
<tr><th>C.P.:</th><td><?php echo $empresa['Empresa']['codigo_postal'];?></td></tr>
<tr><th>RFC:</th><td><?php echo $empresa['Empresa']['rfc'];?></td></tr>
</table>
