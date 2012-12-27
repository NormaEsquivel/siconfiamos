<?php
$menu_elements = array(
	'element' => array(
		'name' => $this->Html->link('Histórico', 
			array(
				'controller' => 'cobros',
				'action' => 'index'
			)
		)
	),
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
		<h3 class = "thin underline">Elegir Empresa</h3>
		<ol>
		<?php foreach($empresas as $empresa): ?>
			<li><?php 
			echo $this->Html->link($empresa['Empresa']['nombre'], array(
				'controller' => 'abonos',
				'action' => 'elegir_empleados',
				$empresa['Empresa']['id']	
			));
			?></li>
		<?php endforeach; ?>
		</ol>
	</div>
</div>