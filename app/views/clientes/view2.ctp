<head>
<?php 
      echo $this->Html->script('src/views/clientes/jquery');
      echo $this->Html->script('src/views/clientes/jquery.tablesorter'); 
      echo $this->Html->script('src/views/clientes/view2');?>
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
<h3>Listado de Clientes</h3>
<br>
<?php echo $this->Html->link('Cotizar Crédito', array('controller' => 'creditos', 'action' => 'cotizar',),array('id'=>'link')); ?>
<br>
<?php echo $this->Html->link('Añadir Cliente', array('controller' => 'empresas', 'action' => 'sesion2')); ?>
<br>
<br>
<table id="clientes">
<thead>
	    <tr>
	    	<th>#</th> 	    	    
	    	<th>Nombre</th>        
	    	<th>Empresa</th>
	    	<th> </th>
	    	<th> </th>
	    	<th> </th>
	    	<th> </th>
	    	<th> </th>
	    </tr>
</thead>
<tbody>
<?php $i = 1; foreach($clientes as $cliente):?>
<tr>
	<td><?php echo $i++; ?></td>
	<td><?php echo $cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'];?></td>
	<td><?php echo $cliente['Empresa']['nombre'].' '.$cliente['Cliente']['division'];?></td>
	<td><?php echo $this->Html->link('Información del cliente', array('controller' => 'clientes', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
	<td><?php echo $this->Html->link('Historial', array('controller' => 'creditos', 'action' =>'historial', $cliente['Cliente']['id'])); ?></td>
	<td><?php echo $this->Html->link('Créditos', array('controller' => 'creditos', 'action' => 'view', $cliente['Cliente']['id'])); ?></td>
	<td><?php echo $this->Html->link('Eliminar', array('controller' => 'clientes', 'action' => 'delete', $cliente['Cliente']['id'])); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>