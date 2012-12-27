<?php
echo $this->Html->css('portal/formValidator/developr.validationEngine.css?v=1');
echo $this->Html->script('src/portal/libs/formValidator/jquery.validationEngine.js?v=1', array('inline' => false));	
echo $this->Html->script('src/portal/libs/formValidator/languages/jquery.validationEngine-es.js?v=1', array('inline' => false));	
echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js', array('inline' => false) ); 
$this->Html->script('src/views/empresas/add.js', array('inline' => false));
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
$secondElementClass = 'current';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
?>

<?php echo $this->Form->create('Empresa', array(
	'url' => array(
		'controller' => 'empresas',
		'action' => 'edit'
	),
	'id' => 'new-credit-form'
));
?>

<?php echo $this->Form->input('id'); ?>

<div class = "columns">
	<div class="six-columns">

		<h3 class = "thin underline">Nueva</h3>


		<?php 
		echo $this->Form->input('nombre', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Nombre'
			),
			'type' => 'text',
			'class' => 'input small-margin-right validate[required]'

		));
		?>

		<?php 
		echo $this->Form->input('representante', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Representante'
			),
			'type' => 'text',
			'class' => 'input small-margin-right'

		));
		?>

		<?php 
		echo $this->Form->input('direccion', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Dirección'
			),
			'class' => 'input small-margin-right validate[required]'

		));
		?>

		<?php 
		echo $this->Form->input('ciudad', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Ciudad'
			),
			'class' => 'input small-margin-right validate[required]'

		));
		?>

		<?php 
		echo $this->Form->input('estado', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Estado'
			),
			'class' => 'input small-margin-right validate[required]'

		));
		?>

		<?php 
		echo $this->Form->input('codigo_postal', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Código Postal'
			),
			'class' => 'input small-margin-right validate[custom[number] minSize[5]]'

		));
		?>

		<?php 
		echo $this->Form->input('telefono', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'label' => array(
				'class' => 'label',
				'text' => 'Telefono'
			),
			'class' => 'input small-margin-right validate[custom[phone]]'

		));
		?>


		<?php 
		echo $this->Form->input('rfc', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'label' => array(
				'class' => 'label',
				'text' => 'RFC'
			),
			'class' => 'input small-margin-right validate[required, validate[custom[onlyLetterNumber]]'

		));
		?>

		<?php 
		echo $this->Form->end(array(
			'class' => 'button blue-gradient glossy',
			'id' => 'submit-button',
			'label' => 'Guardar'
		));
		?>

	</div>
</div>
