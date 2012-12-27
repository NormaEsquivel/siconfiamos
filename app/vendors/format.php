<?php

class format{
	
	function formatoweb($cadena=null){
		$cadena=strtolower($cadena);
		$cadena=str_replace(' ', '-',$cadena);
		$cadena=str_replace('.','',$cadena);
		$cadena=str_replace('ñ','n',$cadena);
		return $cadena;
	}
	
	function fecha($date = null){
		$meses = array('0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');	
		$explode = explode('-', $date);
		$fecha = $explode[2] . ' de ' . $meses[$explode[1][0]*10+$explode[1][1]] . ' de ' . $explode[0]; 
		return $fecha;
	}
	
	function fechapago($date = null){
		$meses = array('0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');	
		$explode = explode('-', $date);
		$fecha = $explode[0] . ' de ' . $meses[$explode[1][0]*10+$explode[1][1]] . ' de ' . $explode[2]; 
		return $fecha;
	}
	
	function fechacalendario($date = null){
		$meses = array('0', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');	
		$explode = explode('/', $date);
		$fecha = $explode[1] . ' de ' . $meses[$explode[0][0]*10+$explode[0][1]] . ' de ' . $explode[2]; 
		return $fecha;
	}

	function menugenerator($menu_elements = null, $close_element = null, $menu = null){
		foreach($menu_elements as $key => $element){
			if(strpos($key, 'element')){
				$menu = $menu . '
				<li class = "with-right-arrow">
					<span>' . $key . '</span>
						<ul class = "big-menu">';
				$close_element = '</ul></li>' . $close_element;
				$aux = $this->menugenerator($element, $close_element, $menu);

				$menu = $aux['menu'];
				$close_element = $aux['close_element'];
			}else{
				$menu = $menu . '<li>' . $element['name'] .'</li>';
			}
		}

		$content['menu'] = $menu;
		$content['close_element'] = $close_element;	
		return $content;
	}
}
?>