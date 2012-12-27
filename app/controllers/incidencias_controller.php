<?php

class IncidenciasController extends AppController{
	var $name='Incidencias';
	var $helpers=array('Html','Form');
	
		function imprimir(){
			if($this->Session->check('User')){
				if($this->Session->check('incidencia')){
					$incidencia=$this->Session->read('incidencia');
					$generales=$this->Session->read('generales');
					$total = $this->Session->read('total');

				Configure::write('debug',0); // Otherwise we cannot use this method while developing
				$this->set('clientes', $this->Session->read('clientes')); 
				$this->set('total', $total); 
				$this->set('incidencia',$incidencia);
				$this->set('generales',$generales);
		        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		        $this->render(); 
				}
			}
		}
		
		function estado($id = null){
			if($this->Session->check('User')){
				if(!empty($this->data)){
					$fecha_inicio = new DateTime($this->data['Incidencia']['fecha_inicio']);
					$fecha_final = new DateTime($this->data['Incidencia']['fecha_final']);
					$id = $this->data['Incidencia']['id'];
				}else{
					$fecha_inicio = new DateTime('01/01/1950');
					$fecha_final = new DateTime();
				}
				
				$this->loadModel('Cliente');
				$this->loadModel('Credito');
				$this->loadModel('Pago');
				
				$clientes = $this->Cliente->find('all', array(
								'conditions' => array(
									'Cliente.empresa_id' => $id
								),
								'fields' => array('id', 'nombre', 'apellido_paterno', 'apellido_materno'),
								'recursive' => 0
							));
							
				foreach($clientes as $cliente){
					$pagos = $this->Credito->Pago->find('all', array(
									'conditions' => array(
										'Credito.cliente_id' => $cliente['Cliente']['id'],
										'Credito.estado' => 'activo',
										'Pago.sitacion' => 'Pagado'
									),
									'recursive' => 0,
									'order' => array('Pago.id' => 'DESC')
									
								));
							
							$anterior = 0;
						
					if($pagos){
						foreach($pagos as $pago){
							$fecha = new DateTime($pago['Pago']['fecha_pagado']);
							$comparacion1 = $fecha_inicio->diff($fecha);
							$comparacion2 = $fecha->diff($fecha_final);
						
						
							if($comparacion1->format('%R%a')>=0 and $comparacion2->format('%R%a')>=0){
								if($anterior < $pago['Pago']['id']){
									$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['pago_actual'] = $pago['Pago']['numero_pago'];
									$anterior = $pago['Pago']['id'];
								}
							} 
						}
						
						if($anterior == 0){
							$numero_pago = 0;
							$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['pago_actual'] = '0/' . $pagos[0]['Credito']['cuotas'] ;
							
						}else{
							$numero_pago = explode('/', $informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['pago_actual']);
						}
						
						$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['cantidad_pagada'] = $numero_pago[0]*round($pagos[0]['Pago']['pago'],2);
						$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['debe'] = ($pagos[0]['Credito']['cuotas']-$numero_pago[0])*round($pagos[0]['Pago']['pago'],2);
						$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['id'] = $pago['Credito']['id'];
						
						
					}else{
						
						$credito_activo = $this->Credito->find('first', array(
							'conditions' => array(
								'Credito.cliente_id' => $cliente['Cliente']['id'],
								'Credito.estado' => 'activo',
							)
						));
						
							if($credito_activo){
								$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['id'] = $credito_activo['Credito']['id'];
								$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['pago_actual'] = '0' . '/' . $credito_activo['Credito']['cuotas'];
								$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['cantidad_pagada'] = 0;
								$informacion[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']]['debe'] = ($credito_activo['Credito']['cuotas'])*round($credito_activo['Pago'][0]['pago'],2);
							}
					}
						
										
				}
				
				$this->set('informacion',$informacion);
				$this->set('id', $id);
			}
		}
		
		// function estadodecuenta($id=null){
			// if($this->Session->check('User')){
				// if($this->Session->check('busqueda')){
					// if($this->Session->check('nombre')){
						// $pagos=$this->Session->read('busqueda');
						// $empresa=$this->Session->read('nombre');
						// $numero_cliente=0;
						// foreach($pagos as $cliente){
							// $cuentanp=0;
							// $cuentap=0;
							// foreach($cliente['Pago'] as $pago){
								// if($pago['sitacion']=='No pagado'){$cuentanp++;}else{$cuentap++;}
							// }
							// $estadodecuenta[$numero_cliente]['nombre']=$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'];
							// $estadodecuenta[$numero_cliente]['cantidad_pago']=$cliente['Pago'][0]['pago'];
							// $estadodecuenta[$numero_cliente]['pagos']=$cuentap;
							// $estadodecuenta[$numero_cliente]['nopagos']=$cuentanp;
							// $cuentanp=0;
							// $cuentap=0;
							// $numero_cliente++;
						// }
						// $this->set('estado_cuenta',$estadodecuenta);
					// }
// 				
				// }
			// }
		// }
		
		
}
