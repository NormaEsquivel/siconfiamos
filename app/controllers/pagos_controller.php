<?php

class PagosController extends AppController{
	var $name='Pagos';
	var $helpers=array('Html','Form');
	
	// function capital($id=null){
		// if($this->Session->check('User')){
// 				
			// if(!empty($this->data)){
				// $credito=$this->Session->read('datos_credito');
				// $pagos=$this->Pago->find('all',array('conditions'=>array('Pago.credito_id'=>$this->data['Pago']['id']), 'recursive' => -1));
				// $cuenta=0;
				// foreach($pagos as $pago){
					// if($pago['Pago']['sitacion']=='No pagado'){
						// break;
					// }else{
						// $cuenta++;
					// }
				// }
// 			
				// switch($credito['Credito']['periodo_cuotas']){
							// case 'diario': 	
							// $tasa=$credito['Credito']['tasa_interes']/100;
							// $tasa=$tasa/360;
							// break;
							// case 'semanal': 	
							// $tasa=$credito['Credito']['tasa_interes']/100;
							// $tasa=$tasa/360;
							// $tasa=$tasa*7;
							// break;
							// case 'quincenal': 	
							// $tasa=$credito['Credito']['tasa_interes']/100;
							// $tasa=$tasa/12;
							// $tasa=$tasa/2;
							// break;
							// case 'mensual': 	
							// $tasa=$credito['Credito']['tasa_interes']/100;
							// $tasa=$tasa/12;
							// break;
				// }
// 			
				// $numero_pagos=count($pagos);
// 				
				// if($this->data['Pago']['abono']<0){
// 					
					// $capital=$pagos[$cuenta]['Pago']['saldo_insoluto']-$this->data['Pago']['abono']+$pagos[$cuenta]['Pago']['pago_capital'];
// 					
				// }else{
// 					
					// if($cuenta>0){
// 						
						// $capital=$pagos[$cuenta-1]['Pago']['saldo_insoluto']-$this->data['Pago']['abono'];
// 					
					// }else{
// 						
						// $capital=$credito['Credito']['prestamo']-$this->data['Pago']['abono'];
// 	
					// }
// 	
				// }
// 					
					// $nuevo_pago=$capital/($numero_pagos-$cuenta);
// 		
// 				
				// for($i=$cuenta;$i<$numero_pagos;$i++){
					// $capital=$capital-$nuevo_pago;
					// $pagos[$i]['Pago']['saldo_insoluto']=$capital;
					// $pagos[$i]['Pago']['pago_capital']=$nuevo_pago;
					// $pagos[$i]['Pago']['pago']=$nuevo_pago+$pagos[$i]['Pago']['intereses']+$pagos[$i]['Pago']['iva_intereses'];
// 					
				// }
// 						
				// if($this->Pago->saveAll($pagos)){
					// $this->redirect(array('controller'=>'creditos','action'=>'view',$credito['Credito']['cliente_id']));
				// }
			// }
			// $this->set('id',$id);
		// }
	// }
	
	
	function actualizar(){
		if($this->Session->check('User')){
			if($this->Session->check('credito')){		
				$credito=$this->Session->read('credito');
				$arreglo=$this->Pago->find('all',array('conditions'=>array('Pago.credito_id'=>$credito['Credito']['id']), 'recursive' => -1));
				$cuenta=count($credito['Pago']);
				$arreglo=$credito['Pago'];
				$aux=$this->data;
				$index=0;
				$reporte['total']=0;
				$reporte['total_interes']=0;
				$reporte['total_iva']=0;
				$reporte['total_capital']=0;
				
				for($i=1;$i<=$cuenta;$i++):
					if($this->data['Pago'][$i]==1):
						if($arreglo[$i-1]['sitacion']=='No pagado'){
						$arreglo[$i-1]['sitacion']='Pagado';
						$arreglo[$i-1]['fecha_pagado']=date('d').'-'.date('m').'-'.date('Y');
						$reporte['Pago'][$index]=$arreglo[$i-1];
						$reporte['total']=$reporte['total']+$arreglo[$i-1]['pago'];
						$reporte['total_capital']=$reporte['total_capital']+$arreglo[$i-1]['pago_capital'];
						$reporte['total_interes']=$reporte['total_interes']+$arreglo[$i-1]['intereses'];
						$reporte['total_iva']=$reporte['total_iva']+$arreglo[$i-1]['iva_intereses'];
						$index++;
						}else{
							$arreglo[$i-1]['sitacion']='No pagado';
						}
					endif;
				endfor;
				
				$this->data=$arreglo;
				
				if(isset($reporte['Pago'])){
					$reporte['Credito']=$credito['Credito'];
					$reporte['Cliente']=$credito['Cliente'];
					$bandera=1;
					$this->Session->write('reporte',$reporte);}else{
						$bandera=0;
				}
				if($this->Pago->saveAll($this->data)){
					$this->Session->setFlash('Sus Pagos se han actualizado con éxito');
					$this->set('id',$credito['Cliente']['id']);
					$this->set('cliente',$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno']);
					$this->set('bandera',$bandera);
					$this->Session->delete('credito');
				}
			}
		}
	}

	function pdfreporte(){
		if($this->Session->check('User')){
			if($this->Session->check('reporte')){
				$this->set('reporte',$this->Session->read('reporte'));
				  Configure::write('debug',0);
				  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		        $this->render(); 
			}
			
		}
	}
	
	function pagos_incidencia(){
		if($this->Session->check('incidencia')){
			$incidencia=$this->Session->read('incidencia');
			$cuenta=0;
			$bandera=0;
			$elementos=count($this->data['Pago']);				
			for($i=1;$i<=$elementos/3;$i++){
				if($this->data['Pago'][$i]==1){
					
					if($this->data['Pago']['fecha' . $i] != null){
						$fecha=explode('/',$this->data['Pago']['fecha' . $i]);
					}else{
						$fecha=array(0 => date('m'),
									1 => date('d'),
									2 => date('Y'));
					}
					
					if($this->data['Pago']['abono' . $i] != null){
						
						$abonoq = $this->Pago->Abono->find('first',array('conditions'=>array('Pago.id' => $incidencia[$i-1]['id']),'order'=>array('Abono.id DESC')));
						
						if($abonoq){
							$saldo = $abonoq['Abono']['saldo'];
						}else{
							$saldo = $incidencia[$i-1]['pago'];
						}
						
						
						if($this->data['Pago']['abono' . $i] < $saldo){
							$abono['pago_id'] = $incidencia[$i - 1]['id'];
							$abono['abono'] = $this->data['Pago']['abono' . $i];
							$abono['fecha_abono'] = $fecha[1].'-'.$fecha[0].'-'.$fecha[2];;
							$abono['saldo'] = $saldo - $this->data['Pago']['abono' . $i];
							
							$this->Pago->Abono->create();
							$this->Pago->Abono->saveAll($abono);
						
							$this->Pago->id = $incidencia[$i -1]['id'];
							
							$this->Pago->set(array(
								'sitacion' => 'abono',
								'fecha_pagado' => $fecha[1].'-'.$fecha[0].'-'.$fecha[2]
							));
							$this->Pago->save();
						
							$banderapago = 2;
							$bandera = 1;

						}else{
							
							if($this->data['Pago']['abono' . $i] == $saldo){
								$abono['pago_id'] = $incidencia[$i - 1]['id'];
								$abono['abono'] = $this->data['Pago']['abono' . $i];
								$abono['fecha_abono'] = $fecha[1].'-'.$fecha[0].'-'.$fecha[2];;
								$abono['saldo'] = $saldo - $this->data['Pago']['abono' . $i];
								
								$this->Pago->Abono->save($abono);
								$banderapago = 1;
								$bandera = 1;
							}else{
								
								$numeropago=explode('/', $incidencia[$i - 1]['numero_pago']);
								
								if($numeropago[0] < $numeropago[1]){
								
									$vecino = $this->Pago->find('neighbors',array('field'=>'id', 'value' => $incidencia[$i-1]['id'], 'recursive' => -1));
									$abonoqsiguiente = $this->Pago->Abono->find('first',array('conditions'=>array('Pago.id' => $vecino['next']['Pago']['pago']),'order'=>array('Abono.id DESC')));
								
									if($abonoqsiguiente){
										$saldosiguiente = $abonoqsiguiente['Abono']['saldo'];
									}else{
										$saldosiguiente = $vecino['next']['Pago']['pago'];
									}
									
									$abono[0]['pago_id'] = $incidencia[$i-1]['id'];
									$abono[0]['abono'] = $saldo;
									$abono[0]['fecha_abono'] = $fecha[1].'-'.$fecha[0].'-'.$fecha[2];;
									$abono[0]['saldo'] = 0;
									
									$abono[1]['pago_id'] = $vecino['next']['Pago']['id'];
									$abono[1]['abono'] = -($saldo - $this->data['Pago']['abono' . $i]);
									$abono[1]['fecha_abono'] = $fecha[1].'-'.$fecha[0].'-'.$fecha[2];
									$abono[1]['saldo'] = $saldosiguiente - $abono[1]['abono'];
									$this->Pago->Abono->saveAll($abono);
									$this->Pago->id = $vecino['next']['Pago']['id'];
									$this->Pago->set(array(
									'sitacion' => 'abono',
									'fecha_pagado' => $fecha[1].'-'.$fecha[0].'-'.$fecha[2]
									));
									$this->Pago->save();
									$banderapago = 1;
									$bandera = 1;
								}
								
							}
						}
					}else{
						$queryabono = $this->Pago->Abono->find('first',array('conditions'=>array('Pago.id' => $incidencia[$i-1]['id']),'order'=>array('Abono.id DESC')));
			
						if($queryabono){
							$abono['pago_id'] = $incidencia[$i - 1]['id'];
							$abono['abono'] = $queryabono['Abono']['saldo'];
							$abono['fecha_abono'] = $fecha[1].'-'.$fecha[0].'-'.$fecha[2];;
							$abono['saldo'] = 0;
							
							$this->Pago->Abono->create();
							$this->Pago->Abono->save($abono);
						}

						$banderapago = 1;
					}
					
					$arreglo[$cuenta]['pago_capital']=$incidencia[$i-1]['pago_capital'];
					$arreglo[$cuenta]['id']=$incidencia[$i-1]['id'];
					$arreglo[$cuenta]['credito_id']=$incidencia[$i-1]['credito_id'];
					$arreglo[$cuenta]['fecha']=$incidencia[$i-1]['fecha'];
					$arreglo[$cuenta]['fecha_pagado']=$fecha[1].'-'.$fecha[0].'-'.$fecha[2];
					$arreglo[$cuenta]['intereses']=$incidencia[$i-1]['intereses'];
					$arreglo[$cuenta]['iva_intereses']=$incidencia[$i-1]['iva_intereses'];
					$arreglo[$cuenta]['pago']=$incidencia[$i-1]['pago'];
					$arreglo[$cuenta]['saldo_insoluto']=$incidencia[$i-1]['saldo_insoluto'];
					$arreglo[$cuenta]['numero_pago']=$incidencia[$i-1]['numero_pago'];
										
					if($banderapago==1){
						$arreglo[$cuenta]['sitacion']='Pagado';	
						$bandera=1;
					}elseif($banderapago != 2){
						$arreglo[$cuenta]['sitacion']='No pagado';
						$arreglo[$cuenta]['fecha_pagado']=0;
						if($bandera!=1){
							$bandera=0;
						}
					}
					$cuenta++;
				}
			}
			$this->data=$arreglo;
			$this->Session->delete('incidencia');
			$this->Session->write('arreglo',$arreglo);
			if($this->Pago->saveAll($arreglo)){
			$this->Session->setFlash('Sus pagos se han actualizado');
			$this->set('bandera',$bandera);
			}			
		}
	}

	
	
	
	function add(){
		if($this->Session->check('User')){
					$num_mes=array('31','28','31','30','31','30','31','31','30','31','30','31');
					$credito=$this->Session->read('credito');
					$dia=$credito['Credito']['fecha_calculo'][9]+$credito['Credito']['fecha_calculo'][8]*10;
					$mes=$credito['Credito']['fecha_calculo'][6]+$credito['Credito']['fecha_calculo'][5]*10;
					$anio=$credito['Credito']['fecha_calculo'][3]+$credito['Credito']['fecha_calculo'][2]*10+$credito['Credito']['fecha_calculo'][1]*100+$credito['Credito']['fecha_calculo'][0]*1000;
					$prestamo=$credito['Credito']['prestamo'];
					$cuotas=$credito['Credito']['cuotas'];
					
					if($credito['Credito']['periodo_cuotas']=='diario'){
						$tasa=$credito['Credito']['tasa_interes']/100;
						$tasa=$tasa/360;
					}
					if($credito['Credito']['periodo_cuotas']=='semanal'){
						$tasa=$credito['Credito']['tasa_interes']/100;
						$tasa=$tasa/360;
						$tasa=$tasa*7;
					}
					if($credito['Credito']['periodo_cuotas']=='quincenal'){
						$tasa=$credito['Credito']['tasa_interes']/100;
						$tasa=$tasa/12;
						$tasa=$tasa/2;
					}
					if($credito['Credito']['periodo_cuotas']=='mensual'){
						$tasa=$credito['Credito']['tasa_interes']/100;
						$tasa=$tasa/12;
					}

					$cuotas = $credito['Credito']['cuotas'];
					
					if($credito['Credito']['tipo_calculo'] == 'insoluto'){
						$tasa = $tasa * 1.16;
						$pago = $prestamo*($tasa*pow((1+$tasa),$cuotas)/(pow((1+$tasa),$cuotas)-1));
					}else{ 
						$pago = $prestamo/$cuotas;
					}
					
						$saldo = $prestamo;
						$interes = $tasa*$saldo;
					
					$credito['Credito']['cuotas'] = $cuotas;
					
					$this->Pago->Credito->id = $credito['Credito']['id'];
					
					
					if($credito['Credito']['tipo_calculo'] == 'insoluto'){
						$this->Pago->Credito->saveField('saldo', round($pago*$cuotas, 2));
					}else{
						$pago_credito = $pago+$interes*1.16;
						$this->Pago->Credito->saveField('saldo', round($pago_credito*$cuotas, 2));
					}
					
					for($cuenta=1;$cuenta<=$cuotas;$cuenta++):
									switch($credito['Credito']['periodo_cuotas']){
								case "diario":
									if($cuenta>1){
										$dia++;
										if($dia>$num_mes[$mes-1]){
											$dia=$dia-$num_mes[$mes-1];
											$mes++;
										};
									};
									if($mes==13){
										$mes=1;
										$anio++;
									};
									break;
								case "semanal":
									if($cuenta>1){
										$dia=$dia+7;
										if($dia>$num_mes[$mes-1]){
											$dia=$dia-$num_mes[$mes-1];
											$mes++;
										};
									};
									if($mes==13){
										$mes=1;
										$anio++;
									};
									break;
								case "quincenal":
											if($cuenta==1){
												if($dia<=15){
													$dia=15;
												}else{
													$dia=$num_mes[$mes-1];
												}
											}else{
												if($dia==15){
													$dia=$num_mes[$mes-1];
												}else{
													$dia=15;
													$mes++;
												}
											};
									if($mes==13){
										$mes=1;
										$anio++;
									};
									break;
								case "mensual":
									if($cuenta>1 or ($dia==$num_mes[$mes-1] and $cuenta==1)){
									$mes++;
									if($mes==13){
										$mes=1;
										$anio++;
									};
									}
									$dia=$num_mes[$mes-1];
									break;
								case "anual":
									$anio++;
									break;}
										
							
							if($credito['Credito']['tipo_calculo'] == 'insoluto'){
								$saldo = $saldo-$pago+$interes;
								$this->data['Pago'][$cuenta-1]['intereses'] = ($interes/1.16);
								$this->data['Pago'][$cuenta-1]['pago_capital'] = $pago-$interes;
								$this->data['Pago'][$cuenta-1]['iva_intereses'] = .16*($interes/1.16);
								$this->data['Pago'][$cuenta-1]['pago'] = $pago;
								$this->data['Pago'][$cuenta-1]['saldo_insoluto'] = $saldo;
								
								$interes = $saldo*$tasa;
								
							}else{
								$saldo=$saldo-$pago;
								$this->data['Pago'][$cuenta-1]['intereses']=$interes;
								$this->data['Pago'][$cuenta-1]['pago_capital']=$pago;
								$this->data['Pago'][$cuenta-1]['iva_intereses']=$interes*.16;
								$this->data['Pago'][$cuenta-1]['pago']=$pago+$interes*1.16;
								$this->data['Pago'][$cuenta-1]['saldo_insoluto']=$saldo;
							}
								$this->data['Pago'][$cuenta-1]['credito_id']=$credito['Credito']['id'];
								$this->data['Pago'][$cuenta-1]['numero_pago']=$cuenta.'/'.$credito['Credito']['cuotas'];
							
							if($dia<10){
								if($mes<10){
								$this->data['Pago'][$cuenta-1]['fecha']="0".$dia."-0".$mes."-".$anio;
								}else{
								$this->data['Pago'][$cuenta-1]['fecha']="0".$dia."-".$mes."-".$anio;
								}
							}else{
								if($mes<10){
								$this->data['Pago'][$cuenta-1]['fecha']=$dia."-0".$mes."-".$anio;
								}else{
								$this->data['Pago'][$cuenta-1]['fecha']=$dia."-".$mes."-".$anio;
								}
							}
							$this->data['Pago'][$cuenta-1]['sitacion']="No pagado";
							$this->data['Credito']['id']=$credito['Credito']['id'];
					endfor;
		$this->Pago->saveAll($this->data['Pago']);
		$this->Session->delete('credito');
		$this->redirect(array('controller' => 'creditos', 'action' => 'view', $credito['Credito']['cliente_id']));
		}
		}
		
		function imprimirpdf($id = null) {
			if($this->Session->check('User')){
		        $pagos=$this->Pago->find('all',array('conditions'=>array('Pago.credito_id'=>$id), 'recursive' => 1));
				
				$totales['total_interes']=0;
				$totales['total_iva']=0;
				$totales['total_pago']=0;
				$totales['total_capital']=0;
				$i = 0;
				
				foreach($pagos as $pago):
					
					
					//if($pago['Pago']['sitacion'] == 'Pagado'){
						$totales['total_capital']=$totales['total_capital']+$pago['Pago']['pago_capital'];
						$totales['total_interes']=$totales['total_interes']+$pago['Pago']['intereses'];
						$totales['total_iva']=$totales['total_iva']+$pago['Pago']['iva_intereses'];
						$totales['total_pago']=$totales['total_pago']+$pago['Pago']['pago'];
					//}
					
					// if($pago['Abono'] != null && $pago['Pago']['sitacion'] == 'Liquidado'){
// 						
						// $abonos = count($pago['Abono']);
// 						
						// $totales['total_pago'] = $totales['total_pago'] + ($pago['Pago']['pago'] - $pago['Abono'][$abonos-1]['saldo']);
						// $pagos[$i]['Pago']['numero_pago'] = 'Abono ' . $pagos[$i]['Pago']['numero_pago'];
						// $pagos[$i]['Pago']['pago'] = ($pago['Pago']['pago'] - $pago['Abono'][$abonos-1]['saldo']);
						// $pagos[$i]['Pago']['sitacion'] = 'Pagado';
					// }
					
					$i++;
				endforeach;
				
				$credito = $this->Pago->find('first', array('conditions' => array('Pago.credito_id' => $id)));
				$this->loadModel('Cliente');
				$cliente = $this->Cliente->find('first',array('conditions' => array('Cliente.id' => $credito['Credito']['cliente_id'])));
				//pr('hola');exit;	
		        Configure::write('debug',0);
				$this->set('cliente', $cliente);
				$this->set('credito', $credito);
				$this->set('totales',$totales); // Otherwise we cannot use this method while developing 
				$this->set('pagos',$pagos);
		        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		        $this->render(); 
			}
    	}

		function pagos_realizados($id = null) {
			if($this->Session->check('User')){
				 
		        $pagos=$this->Pago->find('all',array('conditions'=>array('Pago.credito_id'=>$id), 'recursive' => 1));
				
				if(isset($this->params['url']['pago_actual'])){
				$pago_actual = $this->params['url']['pago_actual'];
				}else{
					$pago_actual = 0;
				}

				$totales['total_interes']=0;
				$totales['total_iva']=0;
				$totales['total_pago']=0;
				$totales['total_capital']=0;
				$i = 0;
				foreach($pagos as $pago):
					
					
					if($pago['Pago']['sitacion'] == 'Pagado'){
						$totales['total_capital']=$totales['total_capital']+$pago['Pago']['pago_capital'];
						$totales['total_interes']=$totales['total_interes']+$pago['Pago']['intereses'];
						$totales['total_iva']=$totales['total_iva']+$pago['Pago']['iva_intereses'];
						$totales['total_pago']=$totales['total_pago']+$pago['Pago']['pago'];
					}
					
					if($i >= $pago_actual){
						unset($pagos[$i]);
					}
					// if($pago['Abono'] != null && $pago['Pago']['sitacion'] == 'Liquidado'){
// 							
						// $abonos = count($pago['Abono']);
// 						
						// $totales['total_pago'] = $totales['total_pago'] + ($pago['Pago']['pago'] - $pago['Abono'][$abonos-1]['saldo']);
						// $pagos[$i]['Pago']['numero_pago'] = 'Abono ' . $pagos[$i]['Pago']['numero_pago'];
						// $pagos[$i]['Pago']['pago'] = ($pago['Pago']['pago'] - $pago['Abono'][$abonos-1]['saldo']);
						// $pagos[$i]['Pago']['sitacion'] = 'Pagado';
					// }
// 					
					$i++;
				endforeach;
				$credito = $this->Pago->find('first', array('conditions' => array('Pago.credito_id' => $id)));
				$this->loadModel('Cliente');
				$cliente = $this->Cliente->find('first',array('conditions' => array('Cliente.id' => $credito['Credito']['cliente_id'])));
		        Configure::write('debug',0);
				$this->set('cliente', $cliente);
				$this->set('credito', $credito);
				$this->set('totales',$totales); // Otherwise we cannot use this method while developing 
				$this->set('pagos',$pagos);
		        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		        $this->render(); 
			}
    	}

		// function liquidar($id = null){
			// if($this->Session->check('User')){
// 				
				// $pagos = $this->Pago->find('all', array(
											// 'conditions' => array(
												// 'Pago.credito_id' => $id, 'Pago.sitacion' => 'No pagado'
												// ),
											// 'order' => array('Pago.created ASC')
										// ));
					// $cuenta=0;
					// $totalabono=0;
					// $totalpago=0;
// 								
				// foreach($pagos as $pago){
					// $pago['Pago']['sitacion'] = 'Liquidado';
					// unset($pago['Pago']['created']);
					// unset($pago['Pago']['modified']);
					// if($pago['Abono']!=null){
							// $abonos = count($pago['Abono']);
							// if($pago['Abono'][$abonos-1]['saldo']!=0){
								// $totalabono=$totalabono+$pago['Abono'][$abonos-1]['abono'];
							// }
					// }
// 					
					// $totalpago=$totalpago+$pago['Pago']['pago_capital'];
// 					
// 					
					// $arreglo[$cuenta]=$pago;
					// $cuenta++;
				// }
				// $totalpago=$totalpago-$totalabono;
				// pr($arreglo);
				// pr($totalpago);exit;
// 				
			// }
// 			
		// }
		
function pagos_atrasados(){
	 $this->layout='template';
	if(!empty($this->data)){
		 	$fecha_inicio= date('d-m-Y', strtotime($this->data['Pago']['fecha_inicio']));
			$fecha_final= date('d-m-Y', strtotime($this->data['Pago']['fecha_final']));
		 }else{
			if(date('d')>15){
				$fecha_final = date('t-m-Y');
				$fecha_inicio = date('16-m-Y');
			}else{
				$fecha_inicio = date('1-m-Y');
				$fecha_final=date('16-m-Y');
			}
		}
		$this->Pago->Behaviors->attach('Containable');
		 $Pagos=$this->Pago->find('all', array(
		 	'conditions'=>array(
		 		'Pago.fecha >='=>$fecha_inicio,
		 		'Pago.fecha <='=>$fecha_final
			),
			'contain' => array(
				'Credito' => array(
					'Cliente' => array('Empresa')
				)
			)
		));	
		$arreglo=null;		
		foreach($Pagos as $key => $Pago){
			$fecha=date($Pago['Pago']['fecha']);
			if(!isset($arreglo[$Pago['Credito']['Cliente']['full_name']])){
				$arreglo[$Pago['Credito']['Cliente']['full_name']]['Empresa']=0;
				$arreglo[$Pago['Credito']['Cliente']['full_name']]['Adeudo']=0;
			}
			$arreglo[$Pago['Credito']['Cliente']['full_name']]['Empresa']=$Pago['Credito']['Cliente']['Empresa']['nombre'];
			if($fecha >= $fecha_inicio and $fecha <= $fecha_final){
				if($Pago['Pago']['Sitacion']='No Pagado'){
					$arreglo[$Pago['Credito']['Cliente']['full_name']]['Adeudo']=$Pago['Pago']['pago'];
				}
			}		
		}
		$this->Session->write('Pagos',$Pagos);
		$this->Session->write('arreglo',$arreglo);
		$this->Session->write('generales','Reporte de Pagos atrasados de '. $fecha_inicio . ' a ' . $fecha_final );
		$this->set('title_for_layout', '');
		$this->set('title','Reporte de Pagos atrasados de '. $fecha_inicio . ' a ' . $fecha_final );
		$this->set('Pagos', $Pagos);
		$this->set('arreglo', $arreglo);
		
		// pr($fecha_inicio);
		// pr($fecha_final);
		// pr($Pagos);
		// pr($arreglo);		
		}
		
	}

?>