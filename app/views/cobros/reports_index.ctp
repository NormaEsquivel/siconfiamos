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
			<li>Reporte de Cobros</li>
			<li>Reporte de Cobros Detallado</li>
		</ol>
	</div>
</div>