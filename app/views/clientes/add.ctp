<?php
echo $this->Html->script('src/views/templates/add_client.js', array('inline' => false));
?>
<?php 
echo $this->Form->create('Cliente', array(
	'url' => array('controller' => 'templates', 'action' => 'add_client'),
	'class' => 'block wizard'
));
?>

		<h3 class="block-title">Nuevo Cliente</h3>

		<fieldset class="wizard-fieldset fields-list">

			<legend class="legend">Información Personal</legend>

				<?php echo $this->Form->input('nombre', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Nombre(s)</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('apellido_paterno', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Apellido Paterno</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>


			<?php echo $this->Form->input('apellido_materno', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Apellido Materno</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('direccion', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Dirección</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('colonia', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Colonia</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('localidad', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Localidad</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('estado', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Estado</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>
			
			<?php echo $this->Form->input('codigo_postal', array(
					'class' => 'input validate[custom[number] minSize[5]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Código Postal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('telefono_1', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono Principal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('telefono_2', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono Secundario</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('fecha_nacimiento', array(
					'class' => 'validate[required] select replacement reversed',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Fecha de Nacimiento</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					),
					'minYear' => date('Y')- 80,
					'maxYear' => date('Y')- 18
			)); ?>

			<?php echo $this->Form->input('dependientes', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Dependientes</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('rfc', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>RFC</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('identificacion', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Identificación</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('curp', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>CURP</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('antiguedad_laboral', array(
					'class' => 'validate[required] input select replacement reversed',
					'type' => 'date',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Antigüedad Laboral</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					),
					'minYear' => date('Y')- 80,
					'maxYear' => date('Y')
			)); ?>
		</fieldset>

		<fieldset class="wizard-fieldset fields-list">

			<legend class="legend">Aval</legend>

			<?php echo $this->Form->input('Aval.nombre', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Nombre(s)</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('Aval.apellido_paterno', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Apellido Paterno</b>'
					),
					'div' => array(
						'class' => 'field-block button-height',
					)
			)); ?>


			<?php echo $this->Form->input('Aval.apellido_materno', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Apellido Materno</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.direccion', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Dirección</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.colonia', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Colonia</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.localidad', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Localidad</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.estado', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Estado</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>
			
			<?php echo $this->Form->input('Aval.codigo_postal', array(
					'class' => 'input validate[custom[number] minSize[5]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Código Postal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.telefono_1', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono Principal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.telefono_2', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono Secundario</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.fecha_nacimiento', array(
					'class' => 'validate[required] input select replacement reversed',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Fecha de Nacimiento</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					),
					'minYear' => date('Y')- 80,
					'maxYear' => date('Y')- 18
			)); ?>

			<?php echo $this->Form->input('Aval.rfc', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>RFC</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.identificacion', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Identificación</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>

			<?php echo $this->Form->input('Aval.curp', array(
					'class' => 'input validate[custom[onlyLetterNumber]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>CURP</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
			)); ?>
			
			<!--<?php echo $this->Html->link('No Aplica',	array(
					'controller' => 'templates',
					'action' => 'NoAplica'
					),
					array(
						'class' => 'button compact icon-card'
					));	?>-->
					

		</fieldset>

		<fieldset class="wizard-fieldset fields-list">

			<legend class="legend">Empresa</legend>


				<?php echo $this->Form->input('empresa_id', array(
					'class' => 'input validate[custom[number]] select replacement reversed',
					'type' => 'select',
					'options' => $empresas,
					'label' => array(
						'class' => 'label',
						'text' => '<b>Empresa en la que trabaja</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

				<?php echo $this->Form->input('division', array(
					'class' => 'input',
					'label' => array(
						'class' => 'label',
						'text' => '<b>División (opcional)</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>


				<?php echo $this->Form->input('Ingreso.salario_imss', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Salario IMSS</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

				<?php echo $this->Form->input('Ingreso.salario_real', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Salario Real</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

				<?php echo $this->Form->input('Ingreso.otros_ingresos', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Salario Real</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

				<?php echo $this->Form->input('Ingreso.egresos_imss', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Egresos IMSS</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

				<?php echo $this->Form->input('Ingreso.egresos_real', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Salario Real</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
				<?php echo $this->Form->input('Ingreso.otros_egresos', array(
					'class' => 'input validate[custom[number]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Salario Real</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
		</fieldset>

		<fieldset class="wizard-fieldset fields-list">

			<legend class="legend">Referencias Personales</legend>

			<?php echo $this->Form->input('Personal.nombre', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Nombre</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.lugar_trabajo', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Lugar de Trabajo</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.direccion', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Dirección</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.colonia', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Colonia</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.localidad', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Localidad</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('Personal.estado', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Estado</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.codigo_postal', array(
					'class' => 'input validate[custom[number] minSize[5]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Código Postal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Personal.telefono', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
		</fieldset>

		<fieldset class="wizard-fieldset fields-list">

			<legend class="legend">Referencias Familiares</legend>

			<?php echo $this->Form->input('Familiar.nombre', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Nombre</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Familiar.parentesco', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Parentesco</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('Familiar.estado_civil', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Estado Civil</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('Familiar.direccion', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Dirección</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Familiar.colonia', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Colonia</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Familiar.localidad', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Localidad</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<?php echo $this->Form->input('Familiar.estado', array(
					'class' => 'input validate[required]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Estado</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Familiar.codigo_postal', array(
					'class' => 'input validate[custom[number] minSize[5]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Código Postal</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>
			<?php echo $this->Form->input('Familiar.telefono', array(
					'class' => 'input validate[custom[phone]]',
					'label' => array(
						'class' => 'label',
						'text' => '<b>Teléfono</b>'
					),
					'div' => array(
						'class' => 'field-block button-height'
					)
				)); ?>

			<div class="field-block button-height wizard-controls align-right">

				<button type="submit" class="button glossy mid-margin-right">
					<span class="button-icon"><span class="icon-tick"></span></span>
					Save
				</button>

			</div>
		</fieldset>

	</form>