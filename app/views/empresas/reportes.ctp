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
<h2>Reportes</h2>
<br>
<br>
<?php echo $this->Html->link('Pagos Atrasados', array('controller' => 'empresas', 'action' => 'pagosatrasados')); ?>
<br>
<?php echo $this->Html->link('Cartera', array('controller' => 'empresas', 'action' => 'reporteCartera')); ?>
<br>
<?php echo $this->Html->link('Créditos Nuevos', array('controller' => 'empresas', 'action' => 'creditosmensual')); ?>
<br>
<?php echo $this->Html->link('Créditos Histórico', array('controller' => 'empresas', 'action' => 'creditoshistorico')); ?>
<br>
<?php echo $this->Html->link('Créditos Terminados', array('controller' => 'creditos', 'action' => 'creditosterminados'));?>
