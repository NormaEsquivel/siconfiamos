<?php
$menu_elements = array(
	'element1' => array(
		'name' => $this->Html->link('Editar', 
			array(
				'controller' => 'clientes',
				'action' => 'edit',
				$cliente['Cliente']['id']
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
$firstElementClass = 'current';
$secondElementClass = '';
$thirdElementClass = '';
$this->set(compact('menu_elements', 'firstElementClass', 'secondElementClass', 'thirdElementClass'));
echo $this->Html->script('src/portal/developr.accordions.js', array(
	'inline' => false
));

?>

<div class="twelve-columns twelve-columns-mobile">

	<h3 class="thin"><?php echo $cliente['Cliente']['full_name'];?></h3>

	<dl class="accordion same-height">

		<dt>Información General del Cliente</dt>
		<dd>
			<div class="with-padding">
				<dl class = "definition inline">
					<dt>Nombre: </dt><dd><?php echo $cliente['Cliente']['full_name']; ?></dd>
					<dt>Dirección: </dt><dd><?php echo $cliente['Cliente']['direccion'] . ' ' . $cliente['Cliente']['colonia'] . ' ' . $cliente['Cliente']['localidad'] . ', ' . $cliente['Cliente']['estado']  . ' C.P.' . $cliente['Cliente']['codigo_postal']; ?></dd>
					<dt>Teléfono: </dt><dd><?php echo $cliente['Cliente']['telefono_1']; ?></dd>
					<dt>Teléfono 2: </dt><dd><?php echo $cliente['Cliente']['telefono_2']; ?></dd>
					<dt>Fecha de Nacimiento: </dt><dd><?php echo $cliente['Cliente']['fecha_nacimiento']; ?></dd>
					<dt>Dependientes económicos: </dt><dd><?php echo $cliente['Cliente']['dependientes']; ?></dd>
					<dt>R.F.C.: </dt><dd><?php echo $cliente['Cliente']['rfc']; ?></dd>
					<dt>I.F.E.: </dt><dd><?php echo $cliente['Cliente']['identificacion']; ?></dd>
					<dt>CURP: </dt><dd><?php echo $cliente['Cliente']['curp']; ?></dd>
					<dt>Antigüedad: </dt><dd><?php echo $cliente['Cliente']['antiguedad_laboral']; ?></dd>
				</dl>
			</div>
		</dd>

		<dt>Aval</dt>
		<dd>
			<div class="with-padding">
				<dl class = "definition inline">
					<dt>Nombre: </dt><dd><?php echo $cliente['Aval']['nombre'] . ' ' . $cliente['Aval']['apellido_paterno'] . ' ' . $cliente['Aval']['apellido_materno']; ?></dd>
					<dt>Dirección: </dt><dd><?php echo $cliente['Aval']['direccion'] . ' ' . $cliente['Aval']['colonia'] . ' ' . $cliente['Aval']['localidad'] . ', ' . $cliente['Aval']['estado']  . ' C.P.' . $cliente['Aval']['codigo_postal']; ?></dd>
					<dt>Teléfono: </dt><dd><?php echo $cliente['Aval']['telefono_1']; ?></dd>
					<dt>Teléfono 2: </dt><dd><?php echo $cliente['Aval']['telefono_2']; ?></dd>
					<dt>Fecha de Nacimiento: </dt><dd><?php echo $cliente['Aval']['fecha_nacimiento']; ?></dd>
					<dt>R.F.C.: </dt><dd><?php echo $cliente['Aval']['rfc']; ?></dd>
					<dt>I.F.E.: </dt><dd><?php echo $cliente['Aval']['identificacion']; ?></dd>
					<dt>CURP: </dt><dd><?php echo $cliente['Aval']['curp']; ?></dd>
				</dl>
			</div>
		</dd>

		<dt>Ingresos/Egresos</dt>
		<dd>
			<div class="with-padding">
				<dl class = "definition inline">
					<dt>Salario IMSS: </dt><dd>$<?php echo number_format($cliente['Ingreso']['salario_imss'], 2); ?></dd>
					<dt>Egreso IMSS: </dt><dd>$<?php echo number_format($cliente['Ingreso']['egresos_imss'], 2); ?></dd>
					<dt>Salario Real: </dt><dd>$<?php echo number_format($cliente['Ingreso']['salario_real'], 2); ?></dd>
					<dt>Egreso Real: </dt><dd>$<?php echo number_format($cliente['Ingreso']['egresos_real'], 2); ?></dd>
					<dt>Otros ingresos: </dt><dd>$<?php echo number_format($cliente['Ingreso']['otros_ingresos'], 2); ?></dd>
					<dt>Otros egresos: </dt><dd>$<?php echo number_format($cliente['Ingreso']['otros_egresos'], 2); ?></dd>
					<dt>Total de ingresos: </dt><dd>$<?php echo number_format($cliente['Ingreso']['total_ingresos'], 2); ?></dd>
					<dt>Total de egresos: </dt><dd>$<?php echo number_format($cliente['Ingreso']['total_egresos'], 2); ?></dd>
				</dl>
			</div>
		</dd>

		<dt>Referencias Familiares</dt>
		<dd>
			<div class="with-padding">
				<dl class = "definition inline">
					<dt>Nombre: </dt><dd><?php echo $cliente['Familiar']['nombre']; ?></dd>
					<dt>Dirección: </dt><dd><?php echo $cliente['Familiar']['direccion'] . ' ' . $cliente['Familiar']['colonia'] . ' ' . $cliente['Familiar']['localidad'] . ', ' . $cliente['Familiar']['estado']  . ' C.P.' . $cliente['Familiar']['codigo_postal']; ?></dd>
					<dt>Teléfono: </dt><dd><?php echo $cliente['Familiar']['telefono']; ?></dd>
					<dt>Parentesco: </dt><dd><?php echo $cliente['Familiar']['parentesco']; ?></dd>
					<dt>Estado civil: </dt><dd><?php echo $cliente['Familiar']['estado_civil']; ?></dd>
				</dl>
			</div>
		</dd>

		<dt>Referencias Personales</dt>
		<dd>
			<div class="with-padding">
				<dl class = "definition inline">
					<dt>Nombre: </dt><dd><?php echo $cliente['Personal']['nombre']; ?></dd>
					<dt>Dirección: </dt><dd><?php echo $cliente['Personal']['direccion'] . ' ' . $cliente['Personal']['colonia'] . ' ' . $cliente['Personal']['localidad'] . ', ' . $cliente['Personal']['estado']  . ' C.P.' . $cliente['Personal']['codigo_postal']; ?></dd>
					<dt>Lugar de Trabajo: </dt><dd><?php echo $cliente['Personal']['lugar_trabajo']; ?></dd>	
				</dl>	
			</div>
		</dd>

	</dl>

</div>