<?php

class AbonosController extends AppController{
	var $name = 'Abonos';
	var $helpers = array('Html', 'Form');
	
	function elegir_empresa(){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$this->loadModel('Empresa');
			$empresas = $this->Empresa->find('all', array(
				'fields' => array('id', 'nombre'),
				'recursive' => 0
			));
			$this->set(compact('empresas'));
		}
	}
	
	function buscar_empresa(){
		 if(!empty($this->data)){
		 	$fecha_inicio= date('Y-m-d', strtotime($this->data['Abono']['fecha_inicio']));
			$fecha_final= date('Y-m-d', strtotime($this->data['Abono']['fecha_final']));
		 }else{
			if(date('d')>15){
				$fecha_final = date('Y-m-t');
				$fecha_inicio = date('Y-m-16');
			}else{
				$fecha_inicio = date('Y-m-1');
				$fecha_final=date('Y-m-16');
			}
		}
		 $this->loadModel('Empresa');
		 $this->Empresa->Cobro->Behaviors->attach('Containable');
		 $empresas=$this->Empresa->Cobro->find('all', array(
		 	'conditions'=>array(
		 		'Cobro.fecha >='=>$fecha_inicio,
		 		'Cobro.fecha <='=>$fecha_final
			),
		 	'contain'=>array(
		 		'Empresa',
		 		'Abono' => array(
		 			'Asociation' => array('Pago')
				)
			),
			'order' => array('Empresa.id')
		));		
		
		$total=null;
		foreach ($empresas as $key => $Abono) {
					
			if(!isset($total[$Abono['Empresa']['nombre']])){
						
				 $total[$Abono['Empresa']['nombre']]['Capital']=0;
				 $total[$Abono['Empresa']['nombre']]['Interes']=0;
				 $total[$Abono['Empresa']['nombre']]['Iva']=0;
				 $total[$Abono['Empresa']['nombre']]['t']=0;
			}
			
			foreach ($Abono['Abono'] as $Asociation) {
				
				if($Asociation['Asociation']!= null ){
						
					foreach ($Asociation['Asociation'] as $key => $Pago) {
						$total[$Abono['Empresa']['nombre']]['Capital'] = $total[$Abono['Empresa']['nombre']]['Capital'] + round($Pago['Pago']['pago_capital'], 2);
						$total[$Abono['Empresa']['nombre']]['Interes'] = $total[$Abono['Empresa']['nombre']]['Interes'] + round($Pago['Pago']['intereses'], 2);
						$total[$Abono['Empresa']['nombre']]['Iva'] = $total[$Abono['Empresa']['nombre']]['Iva'] + round($Pago['Pago']['iva_intereses'], 2);
					}
				}
				else{
					$total[$Abono['Empresa']['nombre']]['Capital']=$total[$Abono['Empresa']['nombre']]['Capital'] + $Asociation['abono'];
				}
				$total[$Abono['Empresa']['nombre']]['t']=$total[$Abono['Empresa']['nombre']]['Capital']+$total[$Abono['Empresa']['nombre']]['Interes']+$total[$Abono['Empresa']['nombre']]['Iva'];
			}
		}
		$this->set(compact('empresas'));
		$this->set('total', $total);
	}
	
	function empresa_detalle(){
		if(!empty($this->data)){
			$fecha_inicio= date('Y-m-d', strtotime($this->data['Abono']['fecha_inicio']));
			$fecha_final= date('Y-m-d', strtotime($this->data['Abono']['fecha_final']));
		 }else{
			if(date('d')>15){
				$fecha_final = date('Y-m-t');
				$fecha_inicio = date('Y-m-16');
			}else{
				$fecha_inicio = date('Y-m-1');
				$fecha_final=date('Y-m-16');
			}
		}
				$this->loadModel('Cliente');
				 $this->Cliente->Credito->Pago->Asociation->Abono->Cobro->Behaviors->attach('Containable');
				 $clientes=$this->Cliente->Credito->Pago->Asociation->Abono->Cobro->find('all', array(
				 	'conditions'=>array(
				 		'Cobro.fecha >='=>$fecha_inicio,
				 		'Cobro.fecha <='=>$fecha_final
					),
				 	'order'=>array(
				 		'Cobro.empresa_id'=> 'ASC'
					),				 
				 	'contain'=>array('Empresa',
				 		'Abono'=>array(
				 			'Asociation'=>array(
				 				'Pago'=>array(
				 					'Credito'=>array(
				 						'Cliente'=>array(
											'order'=>array(
												'Cliente.id'=>'ASC'
											)
										)
									)
								)
							)
						)
					)							
				));
				
				$arreglo=null;
				foreach($clientes as $key => $cobro){
				
					foreach ($cobro['Abono'] as $key => $Abono) {
							
						foreach ($Abono['Asociation'] as $key => $Asociation) {
								
							if(!isset($arreglo[$cobro['Empresa']['nombre']])){
								
								if(!isset($arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']])){
									$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital']=0;
									$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Interes']=0;
									$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Iva']=0;
									$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['t']=0;
								}
							}
						if($Abono['Asociation'] != null){
							foreach ($Abono['Asociation'] as $key => $Pago) 
							{
								$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital']=$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital']
								+$Pago['Pago']['pago_capital'];
								$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Interes']=$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Interes']
								+$Pago['Pago']['intereses'];
								$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Iva']=$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Iva']
								+$Pago['Pago']['iva_intereses'];
							}
					}else{
						$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital']=$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital'] 
						+ $Abono['abono'];
					}
				$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['t']=$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Capital']
				+ $arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Interes']+$arreglo[$cobro['Empresa']['nombre']][$Asociation['Pago']['Credito']['Cliente']['full_name']]['Iva'];
			$this->set(compact('clientes'));
			$this->set('arreglo',$arreglo);
			// pr($clientes);
			// pr($arreglo);
				}
			}
		}
	}
	
	function elegir_empleados($id = null){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$this->loadModel('Cliente');
			$this->loadModel('Credito');
			$clientes = $this->Cliente->find('all', array(
				'conditions' => array('Cliente.empresa_id' => $id),
				'fields' => array('full_name', 'id', 'apellido_paterno', 'empresa_id'),
				'order' => array('apellido_paterno' => 'ASC'),
				'contain' => false
			));
			
			
			foreach($clientes as $key => $cliente){
				if(empty($this->data)){
					$conditions = array(
						'Credito.estado' => 'activo',
						'Credito.cliente_id' => $cliente['Cliente']['id']
					);
				}else{
					$conditions = array(
						'Credito.estado' => 'activo',
						'Credito.cliente_id' => $cliente['Cliente']['id'],
						'Credito.periodo_cuotas' => $this->data['Abono']['periodo']
					);
				}
				
				$activo = $this->Credito->find('count', array(
					'conditions' => $conditions,
					'contain' => false
				));
				
				if($activo == 0){
					$clientes[$key]['Cliente']['credito_activo'] = false;
				}else{
					$clientes[$key]['Cliente']['credito_activo'] = true;
				}
			}
			
			$this->set(compact('id'));
			$this->set(compact('clientes'));
		}
	}
	
	function retrieve(){
		if($this->Session->check('User')){
			$this->layout = 'template';
			if(!empty($this->data)){
				$this->loadModel('Credito');
				$this->loadModel('Pago');
				$i = 0;
				$this->Credito->Behaviors->attach('Containable');
				$this->Pago->Behaviors->attach('Containable');
				foreach($this->data['Abono'] as $cliente){
					if($cliente['addPay']){
						$credito = $this->Credito->find('first', array(
							'conditions' => array(
								'Credito.estado' => 'activo',
								'Credito.cliente_id' => $cliente['id']
							),
							'fields' => array('id','tipo_calculo'),
							'contain' => false
						));
						
									
						$pagos_credito = $this->Pago->find('all', array(
							'conditions' => array(
								'Pago.credito_id' => $credito['Credito']['id'],
								'Pago.sitacion' => 'No pagado'
							),
							'contain' => false
						));

							
						$pagos_atrasados = $this->Pago->find('count', array(
							'conditions' => array(
								'Pago.sitacion' => 'No pagado',
								'Pago.credito_id' => $credito['Credito']['id'],
								'Pago.fecha_bien <' => date('Y-m-d')
							),
							'contain' => false
						));
						
						$pagos[$i] = $this->Pago->find('first', array(
								'conditions' => array(
									'Pago.sitacion' => 'No pagado',
									'Pago.credito_id' => $credito['Credito']['id']
								),
								'contain' => false
						));
						
						if($pagos[$i]['Pago']['saldo_pago'] == null ){
							$pagos[$i]['Pago']['saldo_pago_actual'] = $pagos[$i]['Pago']['pago'];
						}else{
							$pagos[$i]['Pago']['saldo_pago_actual'] = $pagos[$i]['Pago']['saldo_pago'];
						}
						
						$pagos[$i]['Credito']['saldo'] = 0;
						foreach($pagos_credito as $pago){
							$pagos[$i]['Credito']['saldo'] = $pagos[$i]['Credito']['saldo'] + round($pago['Pago']['pago'],2);
						}
						
						if($pagos[$i]['Pago']['saldo_pago'] == null){
							$pagos[$i]['Pago']['saldo_pago'] = $pagos[$i]['Pago']['pago'];
							
						}
						
						$pagos[$i]['Pago']['saldo_total'] = $pagos[$i]['Pago']['saldo_pago'];
						
						if($pagos_atrasados > 0){
							$atrasados = $this->Pago->find('all', array(
								'conditions' => array(
									'Pago.sitacion' => 'No pagado',
									'Pago.id <>' => $pagos[$i]['Pago']['id'],
									'Pago.credito_id' => $credito['Credito']['id'],
									'Pago.fecha_bien <' => date('Y-m-d')
								),
								'contain' => false
							));
													
							foreach($atrasados as $atrasado){							
								
								if($atrasado['Pago']['saldo_pago'] == null){
									$pagos[$i]['Pago']['saldo_total'] = $pagos[$i]['Pago']['saldo_total'] + round($atrasado['Pago']['pago'], 2);
								}else{
									$pagos[$i]['Pago']['saldo_total'] = $pagos[$i]['Pago']['saldo_total'] + round($atrasado['Pago']['saldo_pago'], 2);
								}
								
							}
							
						}
						
						
						$pagos[$i]['Credito']['tipo_calculo'] = $credito['Credito']['tipo_calculo'];
						$pagos[$i]['Cliente']['id'] = $cliente['id'];
						$pagos[$i]['Cliente']['empresa_id'] = $cliente['empresa_id'];
						$pagos[$i]['Cliente']['nombre'] = $cliente['name'];
						$i++;
					}
				}
				$this->set(compact('pagos'));
			}
		}
	}
	
	function add(){
		if($this->Session->check('User')){
			$this->layout = 'template';
			if(!empty($this->data)){
				$this->loadModel('Pago');
				$this->loadModel('Credito');
				$this->Abono->Cobro->create();
				
				if($this->data['Abono'][0]['fecha_abono'] != null){
					$explode_fecha = explode('/', $this->data['Abono'][0]['fecha_abono']);
					$fecha_cobro = $explode_fecha[2] . '-' . $explode_fecha[1] . '-' . $explode_fecha[0];
				}else{
					$fecha_cobro = date('Y-m-d');
				}
				$this->Abono->Cobro->save(array(
					'empresa_id' => $this->data['Abono'][0]['empresa_id'],
					'fecha' => $fecha_cobro
				));
				
				$id = $this->Abono->Cobro->id;
				
				foreach($this->data['Abono'] as $deposito){
				
					//Se asegura que haya una cantidad en el campo de deposito y que esta no sea mayor que el adeudo total
					if($deposito['deposito'] != null){
						if($deposito['deposito'] <= $deposito['saldo_credito']){
							
							//Se posiciona el puntero en el credito actual y se actualiza el saldo del credito
							
							//Se crea el abono y se guarda la información del depósito
							$this->Abono->create();
							$this->Abono->Asociation->create();
							$this->Abono->save(array(
								'cliente_id' => $deposito['cliente_id'],
								'cobro_id' => $id,
								'abono' => $deposito['deposito']
							));
							
							$abono_id = $this->Abono->id;
							//Se redondea el pago para hacer comparaciones adecuadas
							$pago_redondeado = round($deposito['monto_pago'], 2);
							$deposito_redondeado = round($deposito['deposito'],2);
							$pago_regular = round($deposito['pago_regular'], 2);
							//Si el pago es igual al adeudo
							 if($deposito_redondeado == $pago_redondeado){
	
								 $pago_anterior = $this->Pago->find('first', array(
								 	'conditions' => array(
										'Pago.id <' => $deposito['pago_id'],
										'Pago.credito_id' => $deposito['credito_id']
									),
									'order' => array(
										'Pago.id' => 'DESC'
									),
									'recursive' => -1
								 ));
								 
								 
								if($deposito['tipo_calculo'] == 'insoluto' && 
								(strtotime('now') < strtotime($deposito['fecha'])) && 
								(strtotime('now') < strtotime($pago_anterior['Pago']['fecha_bien'])))
								{
										$cantidad_depositada = round(round($deposito['deposito'], 2));
										$siguientes_pagos = $this->Pago->find('all', array(
													'conditions' => array(
														'Pago.id >=' =>  $deposito['pago_id'],
														'Pago.credito_id' => $deposito['credito_id']
													),
													'recursive' => -1
											));
										
										
										$cuotas = 0;
										$total_capital = 0;
										
										foreach($siguientes_pagos as $pago){
											$cuotas = $cuotas + 1;
											$total_capital = $total_capital + $pago['Pago']['pago_capital'];
										}
										
										$credito = $this->Credito->find('first', array(
											'conditions' => array(
												'Credito.id' => $deposito['credito_id']
											)
										));
										
										switch($credito['Credito']['periodo_cuotas']){
											case 'quincenal':
												$divisor = 24;	
											break;
											case 'mensual':
												$divisor = 12;
											break;
											case 'semanal':
												$divisor = (7/360);
											break;
										}
										
										$interes = $credito['Credito']['tasa_interes'] / $divisor;
										$interes = $interes*1.16;
										$interes = $interes / 100;
										
										$total_capital = $total_capital - $cantidad_depositada;
										
										$pago = $total_capital*($interes*pow((1+$interes),$cuotas)/(pow((1+$interes),$cuotas)-1));
										
										$pago_interes = $total_capital*$interes;
		
										foreach($siguientes_pagos as $key => $pablito){
											$total_capital = $total_capital - $pago + $pago_interes;
											$siguientes_pagos[$key]['Pago']['saldo_insoluto'] = $total_capital;
											$siguientes_pagos[$key]['Pago']['intereses'] = $pago_interes/1.16;
											$siguientes_pagos[$key]['Pago']['pago_capital'] = $pago - $pago_interes;
											$siguientes_pagos[$key]['Pago']['iva_intereses'] = .16*($pago_interes/1.16);
											$siguientes_pagos[$key]['Pago']['pago'] = $pago;
											$pago_interes = $total_capital*$interes;
											
										}
					
										$this->Pago->saveAll($siguientes_pagos);
									
								}else{
								 	$this->Pago->id = $deposito['pago_id'];
									$this->Pago->save(array(
										'abono_id' => $abono_id, 
										'sitacion' => 'Pagado'
									));
									$this->Abono->Asociation->save(array(
										'pago_id' => $deposito['pago_id'],
										'abono_id' => $abono_id,
										'abono' => $deposito_redondeado
									));
								}
							
							//Si se pago una cantidad mayor al adeudo
							 }elseif($deposito_redondeado > $pago_redondeado){
							 	
								if($deposito['tipo_calculo'] == 'capital' || $deposito['tipo_calculo'] == 'simple'){
									//Estima cuantas iteraciones necesitará para calcular los pagos
									$numero_pagos = $deposito['deposito']/$pago_regular;
									$numero_pagos_redondeo = floor($numero_pagos);
		
									//Determina el número de iteraciones necesarias
									if($numero_pagos > $numero_pagos_redondeo){
										$iteraciones = $numero_pagos_redondeo +1;
									}else{
										$iteraciones = $numero_pagos_redondeo;
									}
									
									//Itera para la cantidad excendente
									for($i=1;$i<=$iteraciones;$i++){
										
										//Elige el id del pago en turno
										if($i == 1){
											$pago['Pago']['id'] = $deposito['pago_id'];
										}else{
											$pago = $this->Pago->find('first', array(
												'conditions' => array(
													'Pago.credito_id' => $deposito['credito_id'],
													'Pago.id >' => $deposito['pago_id']
												),
												'fields' => array('id', 'saldo_pago'),
												'recursive' => 0
											));
										}
										
										$this->Pago->create();
										$this->Abono->Asociation->create();
										$this->Pago->id = $pago['Pago']['id'];
										//Si la cantidad depositada es mayor que el monto del pago
										if(round($deposito['deposito'],2) >= round($deposito['monto_pago'],2)){
											//Salva la información, actualiza el saldo y cambia el estado del pago
											$this->Pago->save(array(
												'abono_id' => $abono_id,
												'sitacion' => 'Pagado',
												'saldo_pago' => 0
											));
											$this->Abono->Asociation->save(array(
												'pago_id' => $pago['Pago']['id'],
												'abono_id' => $abono_id,
												'abono' => $deposito['monto_pago']
												
											));
											//Actualiza los valores para cuando realice la siguiente iteración
											$deposito['pago_id'] = $pago['Pago']['id'];
											$deposito['deposito'] = $deposito['deposito'] - $deposito['monto_pago'];
											$deposito['monto_pago'] = $deposito['pago_regular'];
											
										}else{
											//Debido a que la cantidad de depósito no es mayor que el total del pago solamente actualiza el saldo
											$this->Pago->save(array(
												'abono_id' => $abono_id, 
												'saldo_pago' => $deposito['pago_regular'] - $deposito['deposito']
												)
											);
											$this->Abono->Asociation->save(array(
												'pago_id' => $pago['Pago']['id'],
												'abono_id' => $abono_id,
												'abono' => $deposito['deposito']
											));
										}
									}
									
						
								}elseif($deposito['tipo_calculo'] == 'insoluto'){
									
									$this->Pago->id = $deposito['pago_id'];
									$pago_actual = $this->Pago->read();
									if($pago_actual['Pago']['saldo_pago'] == null){
										$deposito_asociation = $pago_actual['Pago']['pago'];
									}else{
										$deposito_asociation = round($pago_actual['Pago']['saldo_pago'], 2 );
									}

									$fecha_hoy = strtotime(date('Y-m-d'));
									$fecha_pago_actual = strtotime($pago_actual['Pago']['fecha_bien']);
									
									if($fecha_hoy > $fecha_pago_actual){
											
										$this->Pago->save(array(
											'abono_id' => $abono_id, 
											'sitacion' => 'Pagado',
											'saldo_pago' => 0
										));
										
										$this->Abono->Asociation->save(array(
											'pago_id' => $deposito['pago_id'],
											'abono_id' => $abono_id,
											'abono' => $deposito_asociation
										));
										
										$cantidad_depositada = round(round($deposito['deposito'], 2) - $pago_redondeado, 2);
										
										$numero_pagos = $cantidad_depositada / $pago_regular;
										$iteraciones = ceil($numero_pagos);
			
										//Determina el número de iteraciones necesarias
										
	
										for($i = 1; $i <= $iteraciones; $i++){
											
											$siguiente_pago = $this->Pago->find('first', array(
												'conditions' => array(
													'Pago.id >' =>  $deposito['pago_id'],
													'Pago.credito_id' => $deposito['credito_id']
												),
												'recursive' => -1
											));
											
											if($siguiente_pago['Pago']['saldo_pago'] == null){
												$siguiente_pago['Pago']['saldo_pago'] = $siguiente_pago['Pago']['pago'];
											}
											
											$siguiente_pago['Pago']['saldo_pago'] = round($siguiente_pago['Pago']['saldo_pago'], 2);
	
											$fecha_pago = strtotime($siguiente_pago['Pago']['fecha_bien']);
											
											if($fecha_hoy > $fecha_pago){
												$ciclo_anterior = 0;
												if($cantidad_depositada >= $siguiente_pago['Pago']['saldo_pago']){
													$this->Pago->create();
													$this->Abono->Asociation->create();
													$this->Pago->id = $siguiente_pago['Pago']['id'];	
													$this->Pago->save(array(
														'abono_id' => $this->Abono->id, 
														'sitacion' => 'Pagado',
														'saldo_pago' => 0
													));
													$this->Abono->Asociation->save(array(
														'pago_id' => $siguiente_pago['Pago']['id'],
														'abono_id' => $abono_id,
														'abono' => $siguiente_pago['Pago']['saldo_pago']
													));
													
													$cantidad_depositada = round(($cantidad_depositada - $siguiente_pago['Pago']['saldo_pago']), 2);
													$deposito['pago_id'] = $siguiente_pago['Pago']['id'];
												}else{
	
													$this->Pago->create();
													$this->Abono->Asociation->create();
													$this->Pago->id = $siguiente_pago['Pago']['id'];	
													$this->Pago->save(array(
														'abono_id' => $abono_id, 
														'saldo_pago' => round(($siguiente_pago['Pago']['saldo_pago']- $cantidad_depositada), 2)
													));
													$this->Abono->Asociation->save(array(
														'pago_id' => $siguiente_pago['Pago']['id'],
														'abono_id' => $abono_id,
														'abono' => $cantidad_depositada
													));
													
												}
											}else{
												
												if($ciclo_anterior){
													$siguientes_pagos = $this->Pago->find('all', array(
														'conditions' => array(
															'Pago.id >' =>  $deposito['pago_id'],
															'Pago.credito_id' => $deposito['credito_id']
														),
														'recursive' => -1
													));
													$cuotas = 0;
													$total_capital = 0;
													
													foreach($siguientes_pagos as $pago){
														$cuotas = $cuotas + 1;
														$total_capital = $total_capital + $pago['Pago']['pago_capital'];
													}
													
													$credito = $this->Credito->find('first', array(
														'conditions' => array(
															'Credito.id' => $deposito['credito_id']
														)
													));
													
													switch($credito['Credito']['periodo_cuotas']){
														case 'quincenal':
															$divisor = 24;	
														break;
														case 'mensual':
															$divisor = 12;
														break;
														case 'semanal':
															$divisor = (7/360);
														break;
													}
													
													$interes = $credito['Credito']['tasa_interes'] / $divisor;
													$interes = $interes*1.16;
													$interes = $interes / 100;
													$total_capital = $total_capital - $cantidad_depositada;
													$pago = $total_capital*($interes*pow((1+$interes),$cuotas)/(pow((1+$interes),$cuotas)-1));
													
													$pago_interes = $total_capital*$interes;
					
													foreach($siguientes_pagos as $key => $pablito){
														$total_capital = $total_capital - $pago + $pago_interes;
														$siguientes_pagos[$key]['Pago']['saldo_insoluto'] = $total_capital;
														$siguientes_pagos[$key]['Pago']['intereses'] = $pago_interes/1.16;
														$siguientes_pagos[$key]['Pago']['pago_capital'] = $pago - $pago_interes;
														$siguientes_pagos[$key]['Pago']['iva_intereses'] = .16*($pago_interes/1.16);
														$siguientes_pagos[$key]['Pago']['pago'] = $pago;
														$pago_interes = $total_capital*$interes;
														
													}
								
													$this->Pago->saveAll($siguientes_pagos);
													
													$i = $iteraciones+1;
												}else{
													$ciclo_anterior = 1;
													if($cantidad_depositada >= $siguiente_pago['Pago']['saldo_pago']){
														$this->Pago->create();
														$this->Pago->id = $siguiente_pago['Pago']['id'];	
														$this->Pago->save(array(
															'abono_id' => $this->Abono->id, 
															'sitacion' => 'Pagado',
															'saldo_pago' => 0
														));
														
														$cantidad_depositada = round(($cantidad_depositada - $siguiente_pago['Pago']['saldo_pago']), 2);
														
														$this->Abono->Asociation->save(array(
															'pago_id' => $siguiente_pago['Pago']['id'],
															'abono_id' => $abono_id,
															'abono' => $siguiente_pago['Pago']['saldo_pago']
														));
														
														
														$deposito['pago_id'] = $siguiente_pago['Pago']['id'];
													}else{
	
														$this->Pago->create();
														$this->Abono->Asociation->create();
														$this->Pago->id = $siguiente_pago['Pago']['id'];	
														$this->Pago->save(array(
															'abono_id' => $this->Abono->id, 
															'saldo_pago' => round(($siguiente_pago['Pago']['saldo_pago']- $cantidad_depositada), 2)
														));
														
														$this->Abono->Asociation->save(array(
															'pago_id' => $siguiente_pago['Pago']['id'],
															'abono_id' => $abono_id,
															'abono' => $cantidad_depositada
														));
													}
												}
												
											}
											
										}
									}else{
										
										$pago_anterior = $this->Pago->find('first', array(
											'conditions' => array(
												'Pago.id <' => $deposito['pago_id'],
												'Pago.credito_id' => $deposito['credito_id']
											),
											'order' => array(
												'Pago.id' => 'DESC'
											),
											'recursive' => -1
										));
										if($fecha_hoy > strtotime($pago_anterior['Pago']['fecha_bien'])){
											
											$this->Pago->save(array(
												'abono_id' => $abono_id, 
												'sitacion' => 'Pagado',
												'saldo_pago' => 0
											));
											
											$cantidad_depositada = round(round($deposito['deposito'], 2) - $pago_redondeado, 2);
											
											$this->Abono->Asociation->save(array(
												'pago_id' => $deposito['pago_id'],
												'abono_id' => $abono_id,
												'abono' => $pago_redondeado
											));
											
											$siguientes_pagos = $this->Pago->find('all', array(
													'conditions' => array(
														'Pago.id >' =>  $deposito['pago_id'],
														'Pago.credito_id' => $deposito['credito_id']
													),
													'recursive' => -1
											));
											
										}else{
	
											$cantidad_depositada = round(round($deposito['deposito'], 2));
											$siguientes_pagos = $this->Pago->find('all', array(
													'conditions' => array(
														'Pago.id >=' =>  $deposito['pago_id'],
														'Pago.credito_id' => $deposito['credito_id']
													),
													'recursive' => -1
											));
										}
										
										
										$cuotas = 0;
										$total_capital = 0;
										
										foreach($siguientes_pagos as $pago){
											$cuotas = $cuotas + 1;
											$total_capital = $total_capital + $pago['Pago']['pago_capital'];
										}
										
										$credito = $this->Credito->find('first', array(
											'conditions' => array(
												'Credito.id' => $deposito['credito_id']
											)
										));
										
										switch($credito['Credito']['periodo_cuotas']){
											case 'quincenal':
												$divisor = 24;	
											break;
											case 'mensual':
												$divisor = 12;
											break;
											case 'semanal':
												$divisor = (7/360);
											break;
										}
										
										$interes = $credito['Credito']['tasa_interes'] / $divisor;
										$interes = $interes*1.16;
										$interes = $interes / 100;
										
										$total_capital = $total_capital - $cantidad_depositada;
										
										$pago = $total_capital*($interes*pow((1+$interes),$cuotas)/(pow((1+$interes),$cuotas)-1));
										
										$pago_interes = $total_capital*$interes;
		
										foreach($siguientes_pagos as $key => $pablito){
											$total_capital = $total_capital - $pago + $pago_interes;
											$siguientes_pagos[$key]['Pago']['saldo_insoluto'] = $total_capital;
											$siguientes_pagos[$key]['Pago']['intereses'] = $pago_interes/1.16;
											$siguientes_pagos[$key]['Pago']['pago_capital'] = $pago - $pago_interes;
											$siguientes_pagos[$key]['Pago']['iva_intereses'] = .16*($pago_interes/1.16);
											$siguientes_pagos[$key]['Pago']['pago'] = $pago;
											$pago_interes = $total_capital*$interes;
											
										}
					
										$this->Pago->saveAll($siguientes_pagos);
										
									}
	
								}
								
							 }elseif($deposito_redondeado < $pago_redondeado){
							
								 $pago_anterior = $this->Pago->find('first', array(
								 	'conditions' => array(
										'Pago.id <' => $deposito['pago_id'],
										'Pago.credito_id' => $deposito['credito_id']
									),
									'order' => array(
										'Pago.id' => 'DESC'
									),
									'recursive' => -1
								 ));
								if($deposito['tipo_calculo'] == 'insoluto' && 
								(strtotime('now') < strtotime($deposito['fecha'])) && 
								(strtotime('now') < strtotime($pago_anterior['Pago']['fecha_bien'])))
								{
										$cantidad_depositada = round(round($deposito['deposito'], 2));
										$siguientes_pagos = $this->Pago->find('all', array(
													'conditions' => array(
														'Pago.id >=' =>  $deposito['pago_id'],
														'Pago.credito_id' => $deposito['credito_id']
													),
													'recursive' => -1
											));
										
										
										$cuotas = 0;
										$total_capital = 0;
										
										foreach($siguientes_pagos as $pago){
											$cuotas = $cuotas + 1;
											$total_capital = $total_capital + $pago['Pago']['pago_capital'];
										}
										
										$credito = $this->Credito->find('first', array(
											'conditions' => array(
												'Credito.id' => $deposito['credito_id']
											)
										));
										
										switch($credito['Credito']['periodo_cuotas']){
											case 'quincenal':
												$divisor = 24;	
											break;
											case 'mensual':
												$divisor = 12;
											break;
											case 'semanal':
												$divisor = (7/360);
											break;
										}
										
										$interes = $credito['Credito']['tasa_interes'] / $divisor;
										$interes = $interes*1.16;
										$interes = $interes / 100;
										
										$total_capital = $total_capital - $cantidad_depositada;
										
										$pago = $total_capital*($interes*pow((1+$interes),$cuotas)/(pow((1+$interes),$cuotas)-1));
										
										$pago_interes = $total_capital*$interes;
		
										foreach($siguientes_pagos as $key => $pablito){
											$total_capital = $total_capital - $pago + $pago_interes;
											$siguientes_pagos[$key]['Pago']['saldo_insoluto'] = $total_capital;
											$siguientes_pagos[$key]['Pago']['intereses'] = $pago_interes/1.16;
											$siguientes_pagos[$key]['Pago']['pago_capital'] = $pago - $pago_interes;
											$siguientes_pagos[$key]['Pago']['iva_intereses'] = .16*($pago_interes/1.16);
											$siguientes_pagos[$key]['Pago']['pago'] = $pago;
											$pago_interes = $total_capital*$interes;
											
										}
					
										$this->Pago->saveAll($siguientes_pagos);
									
								}else{
									
								 	$this->Pago->id = $deposito['pago_id'];
									$this->Pago->save(array(
										'abono_id' => $this->Abono->id, 
										'saldo_pago' => $pago_redondeado - $deposito['deposito']
									));
									$this->Abono->Asociation->save(array(
										'pago_id' => $deposito['pago_id'],
										'abono_id' => $abono_id,
										'abono' => $deposito['deposito']
									));
								}
							 }
						}
	
					}
				}
				
			}

			$this->Session->setFlash('Sus pagos han sido aplicados');
			$this->set('id', $id);
		}
		
	}

	function view($id = null){
		
		$abono = $this->Abono->find('first', array(
			'conditions' => array(
				'Abono.id' => $id
			)
		));
		
	}
	
}

	
