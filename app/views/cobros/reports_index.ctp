<?php
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
$firstElementClass = '';
$secondElementClass = '';
$thirdElementClass = '';
$fourthElementClass = 'current';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass', 'fourthElementClass'));

?>
<div class = "columns">
	<div class = "six-columns">
		<h3 class = "thin underline">Elegir Empresa</h3>
		<ol>
			<li><?php echo $this->Html->link('Reporte de Cobros', array('controller' => 'abonos', 'action'=>'buscar_empresa')); ?></li>
			<li><?php echo $this->Html->link('Reporte de Cobros Detallado', array('controller' => 'abonos', 'action'=>'empresa_detalle')); ?></li>
			<li><?php echo $this->Html->link('Reporte de Creditos', array('controller' => 'creditos', 'action'=>'saldo_creditos')); ?></li>
			<li><?php echo $this->Html->link('Reporte de Creditos Detallado', array('controller' => 'creditos', 'action'=>'creditos_detalle')); ?></li>
		</ol>
	</div>
</div>