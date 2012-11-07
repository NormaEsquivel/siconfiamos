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
<body>
	No olvide guardar su reporte de pagos.
</body>
<br>
<br>
<br>

<?php if($bandera==1){
	echo $this->Html->link('Reporte de pagos',array('controller'=>'pagos','action'=>'pdfreporte'));
}?>
<br>
<?php echo $this->Html->link('Credito de '.$cliente, array('controller' => 'creditos', 'action' => 'view',$id)); ?>
