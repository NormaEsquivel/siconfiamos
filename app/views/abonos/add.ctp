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
$thirdElementClass = 'current';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
?>
<div class = "columns">
	<div class = "six-columns">
		<h3 class = "thin">¿Qué desea hacer a continuación?</h3>
		<ul class = "bullet-list">
		<li><?php echo $this->Html->link('Aplicar más pagos', array('controller' => 'abonos', 'action' => 'elegir_empresa')); ?></li>
		<li><?php echo $this->Html->link('Ver los pagos aplicados', array('controller' => 'cobros', 'action' => 'view', $id)); ?></li>
		</ul>
	</div>
</div>