<?php
echo $this->Html->css('portal/formValidator/developr.validationEngine.css?v=1');
echo $this->Html->script('src/portal/libs/formValidator/jquery.validationEngine.js?v=1', array('inline' => false));	
echo $this->Html->script('src/portal/libs/formValidator/languages/jquery.validationEngine-es.js?v=1', array('inline' => false));	
echo $this->Html->script('src/portal/libs/glDatePicker/glDatePicker.min.js', array('inline' => false) ); 
echo $this->Html->script('src/views/templates/add_credit.js', array('inline' => false));
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

$firstElementClass = 'current';
$secondElementClass = '';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));


?>
<?php echo $this->Form->create('Credito', array(
	'url' => array(
		'controller' => 'creditos',
		'action' => 'add'
	),
	'id' => 'new-credit-form'
));
?>
<div class = "columns">
	<div class="six-columns">

		<h3 class = "thin underline">Datos Generales</h3>


		<?php 
		echo $this->Form->input('fecha', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Fecha'
			),
			'type' => 'text',
			'class' => 'input small-margin-right validate[custom[date]] datepicker'

		));
		?>

		<?php 
		echo $this->Form->input('fecha_calculo', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Fecha de cálculo'
			),
			'type' => 'text',
			'class' => 'input small-margin-right validate[custom[date]] datepicker'

		));
		?>

		<?php 
		echo $this->Form->input('cheque', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Número de cheque'
			),
			'class' => 'input small-margin-right validate[required]'

		));
		?>

		<?php 
		echo $this->Form->input('cuotas', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '
			<span class = "info-spot on-top">
				<span class="icon-info-round"></span>
				<span class="info-bubble">
					Favor de poner el tiempo en meses.
				</span>
			</span>
			</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Tiempo'
			),
			'class' => 'input small-margin-right validate[required, custom[number]]'

		));
		?>

		<?php 
		echo $this->Form->input('prestamo', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'label' => array(
				'class' => 'label',
				'text' => 'Préstamo'
			),
			'class' => 'input small-margin-right validate[ required, custom[number]]'

		));
		?>

		<?php 
		echo $this->Form->input('periodo_cuotas', array(
			'div' => false,
			'before' => '<p class = "inline-label button-height">',
			'after' => '</p>',
			'type' => 'select',
			'options' => array(
				'semanal' => 'Semanal',
				'quincenal' => 'Quincenal',
				'mensual' => 'Mensual' 
			),
			'empty' => '(Elija el período de pago)',
			'label' => array(
				'class' => 'label',
				'text' => 'Período'
			),
			'class' => 'select validate[required]'

		));
		?>


	</div>
	<div class="six-columns">
		<h3 class  = "thin underline">Tipo de Cálculo</h3>
			<?php 
		echo $this->Form->input('tipo_calculo', array(
			'div' => false,
			'before' => '<p  id = "second-column" class = "inline-label button-height">',
			'after' => '</p>',
			'type' => 'select',
			'options' => array(
				'insoluto' => 'Saldos Insolutos',
				'capital' => 'Capital Fijo' 
			),
			'empty' => '(Seleccione el tipo de cálculo)',
			'label' => array(
				'class' => 'label',
				'text' => 'Tipo de Cálculo'
			),
			'class' => 'select'

		));
		?>

		<?php 
		echo $this->Form->end(array(
			'class' => 'button blue-gradient glossy',
			'id' => 'submit-button',
			'label' => 'Calcular'
		));
		?>
	</div>
</div>