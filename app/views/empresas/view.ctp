<?php
$menu_elements = array(
	'element2' => array(
		'name' => $this->Html->link('Editar', 
			array(
				'controller' => 'empresas',
				'action' => 'edit',
				$empresa['Empresa']['id']
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
$secondElementClass = 'current';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
echo $this->Html->script('src/portal/developr.accordions.js', array(
	'inline' => false
));

?>

<div class="six-columns">
	<div class = "block">
		<div class="block-title">
			<h3>Información de la Empresa</h3>
			<div class="button-group absolute-right compact">
				<?php echo $this->Html->link('Editar', array(
					'controller' => 'empresas',
					'action' => 'edit',
					$empresa['Empresa']['id']
				), array(
					'class' => 'button icon-pencil with-tooltip',
					'title' => 'Editar'
				));
				?>
			</div>
		</div>
		<div class = "with-padding">
			<dl class = "definition inline">
				<dt>Nombre:</dt><dd><?php echo $empresa['Empresa']['nombre'];?></dd>
				<dt>Dirección:</dt><dd><?php echo $empresa['Empresa']['direccion'];?></dd>
				<dt>Ciudad:</dt><dd><?php echo $empresa['Empresa']['ciudad'];?></dd>
				<dt>Estado:</dt><dd><?php echo $empresa['Empresa']['estado'];?></dd>
				<dt>Telefono:</dt><dd><?php echo $empresa['Empresa']['telefono'];?></dd>
				<dt>C.P.:</dt><dd><?php echo $empresa['Empresa']['codigo_postal'];?></dd>
				<dt>RFC:</dt><dd><?php echo $empresa['Empresa']['rfc'];?></dd>
			</dl>
		</div>
	</div>
</div>
