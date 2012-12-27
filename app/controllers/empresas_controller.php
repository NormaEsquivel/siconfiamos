<?php

class EmpresasController extends AppController{
	var $name='Empresas';
	var $helpers=array('Html','Form');
	
	
	function reportes(){
		if($this->Session->check('User')){
			
		}
	}
	
	function pagosatrasados($id=null){
		if($this->Session->check('User')){
			
			if(!empty($this->data)){
			
			$creditos=$this->Empresa->Cliente->Credito->find('all',array(
				'conditions'=>array(
					'Cliente.empresa_id'=>$this->data['Empresa']['empresa_id'],
					'Credito.estado' => 'activo'
					))
			);
			
			$empresa = $this->Empresa->find('first',array(
				'conditions'=>array(
					'Empresa.id'=>$this->data['Empresa']['empresa_id']
				),
				'recursive' => -1
			));
			
			$datetimehoy = new DateTime('now');
	
			foreach($creditos as $cliente){
				$cuenta = 0;
				foreach($cliente['Pago'] as $pago){
					
					if($pago['sitacion'] == 'No pagado'){
						
						$datetimepago = new DateTime($pago['fecha']);
						$intervalo = $datetimepago->diff($datetimehoy);
						
						if($intervalo->format('%R%a')>1){
							$atrasado[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']][] = $pago;
							$cuenta++;
						}
						
					}
							
				}
				
				
				if($cuenta > 0){
					
				$cuenta_pagos = $this->Empresa->Cliente->Credito->Pago->find('count',array(
				'conditions'=>array(
					'Credito.id' => $cliente['Credito']['id'],
					'Pago.sitacion' => 'Pagado'
					))
				);
					
				$atrasado[$cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno']][0]['saldo'] = ($cliente['Credito']['cuotas'] - $cuenta_pagos)*round($cliente['Pago'][0]['pago'], 2);
				
				}
			}
			 
			 $this->Session->write('atrasado', $atrasado);
			 
			 $this->set('atrasado',$atrasado);
			 $this->set('empresa',$empresa);
		}
		 
		 	$empresas = $this->Empresa->find('all', array(
			 	'fields' => array('id', 'nombre'),
			 	'recursive' => -1
			 ));
			 
			 $opciones = Set::combine($empresas, '{n}.Empresa.id', '{n}.Empresa.nombre');
			
			 $this->set(compact('opciones'));
		}
	}

	function exportar_atrasados(){
		if($this->Session->check('User')){
			if($this->Session->check('atrasado')){
				App::import('Vendor', 'format');
				$format = new format();	
				ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
				$this->autoRender=false;
				//create a file
				$filename = "pagos_atrasados_".date("Y-m-d").".csv";
				$csv_file = fopen('php://output', 'w');
			
				header('Content-type: application/csv');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
			
				$atrasado = $this->Session->read('atrasado');
				// The column headings of your .csv file
				$header_row = array("Cliente", "Numero de pago", "Fecha de pago", "Monto del pago", "Saldo");
				fputcsv($csv_file,$header_row,',','"');
				foreach($atrasado as $cliente => $pagos):
					$row = array(
						$cliente,
						" ",
						" ",
						" ",
						" "
					);
					
					fputcsv($csv_file,$row,',','"');
					
					foreach($pagos as $pago):
						$numero_pago = explode('/', $pago['numero_pago']);
						$row = array(
							" ",
							$numero_pago[0] . " de " . $numero_pago[1],
							$format->fechapago($pago['fecha']),
							"$" . number_format($pago['pago'], 2),
							"$" . number_format($atrasado[$cliente][0]['saldo'],2)
						);
						fputcsv($csv_file,$row,',','"');
					endforeach;
					
					
				endforeach;
			}
			
		}
		
	}
	
	function delete($id=null){
		if($this->Session->check('User')){
			$this->Empresa->delete($id,true);
			$this->redirect(array('controller'=>'users','action'=>'sesion',2));
		}
	}
	
	function add(){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$usuario=$this->Session->read('User');
		if(!empty($this->data)){
			$this->data['Empresa']['user_id']=$usuario['User']['id'];
			if($this->Empresa->save($this->data)){
				$this->Session->setFlash('Su información se ha guardado con éxito');
				$this->redirect(array('controller'=>'users','action'=>'sesion', 2));
			}
		}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('controller'=>'users','action'=>'index'));		
		}
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$this->set('title_for_layout', '');
			$usuario=$this->Session->read('User');
			$empresa=$this->Empresa->find('first',array('conditions'=>array('Empresa.id'=>$id)));
				
				$this->set('empresa',$empresa);
			
		}else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('controller'=>'users','action'=>'index'));		
		}
	}
	
	function cliente_view($id=null){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$usuario=$this->Session->read('User');
			$this->Session->delete('empresa');	
			$cuenta=$this->Empresa->Cliente->find('count',array('conditions'=>array('Cliente.empresa_id'=>$id)));
		 if($cuenta>0){
			$clientes=$this->Empresa->Cliente->find('all',array('conditions'=>array('Cliente.empresa_id'=>$id), 'recursive' => 0));
			$empresa=$this->Empresa->find('first',array('conditions'=>array('Empresa.id'=>$id)));
			$this->set('clientes',$clientes);
			$this->set('id',$usuario['User']['id']);
			$this->set('empresa',$empresa);
			$this->Session->write('empresa',$empresa);
			$this->set('title_for_layout', 'Clientes de ' . $empresa['Empresa']['nombre']);
		 }else{
		 		$empresa=$this->Empresa->find('first',array('conditions'=>array('Empresa.id'=>$id)));
		 		$this->Session->write('empresa',$empresa);
				$this->Session->setFlash('Esta empresa aún no tiene clientes');
				$this->redirect(array('controller'=>'clientes','action'=>'add'));
			}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('controller'=>'users','action'=>'index'));		
		}
	}
	
	function sesion($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$this->Session->delete('empresa');
			$empresa=$this->Empresa->find('first',array('conditions'=>array('Empresa.id'=>$id)));
				$this->Session->write('empresa',$empresa);
				$this->redirect(array('controller'=>'clientes','action'=>'add'));
		}
	}

	function sesion2(){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$this->Session->delete('empresa');
			$empresa=$this->Empresa->find('all');
				$this->Session->write('empresa',$empresa);
				$this->redirect(array('controller'=>'clientes','action'=>'add2'));
		}
	}
	
	function edit($id=null){
		if($this->Session->check('User')){
		$this->layout = 'template';
		 $usuario=$this->Session->read('User');
		 $empresa=$this->Empresa->find('first',array('conditions'=>array('Empresa.id'=>$id)));
			 $this->Empresa->id=$id;
				if(empty($this->data)){
				 $this->data=$this->Empresa->read();
				}else{
					if($this->Empresa->save($this->data)){
					 $this->Session->setFlash('La información de su cliente se ha actualizado con éxito');
					 $this->redirect(array('controller'=>'users','action'=>'sesion',2));
					}
			}		
		}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('controller'=>'users'));
		}
	}

	function creditosmensual(){
		if($this->Session->check('User')){
			$empresas=$this->Empresa->find('all');
			$cuenta=0;
			$cuenta2=0;
			
			if(!empty($this->data)){
				$fecha_inicio=new DateTime($this->data['Empresa']['fecha_inicio']);
				$fecha_final=new DateTime($this->data['Empresa']['fecha_final']);
				
			}else{
				$fecha_inicio=new DateTime(date('Y') . '-' . date('m') . '-01');
				$fecha_final=new DateTime(date('Y') . '-' . date('m') . '-' . date('t'));				
			}
			
			foreach($empresas as $empresa){
					$arreglo2['Empresa'][$cuenta]['nombre_empresa']=$empresa['Empresa']['nombre'];
				foreach($empresa['Cliente'] as $cliente){
					$creditos=$this->Empresa->Cliente->Credito->find('all',array(
						'conditions'=>array(
							'Credito.cliente_id'=>$cliente['id'],
							'Credito.estado <>' =>	'finalizado'
					)));
						if($creditos){
							foreach($creditos as $credito){
								$fecha=new DateTime($credito['Credito']['fecha']);
								$comparacion1=$fecha_inicio->diff($fecha);
								$comparacion2=$fecha->diff($fecha_final);
									if($comparacion1->format('%R%a')>=0 and $comparacion2->format('%R%a')>=0){
										$arreglo2['Empresa'][$cuenta]['Cliente'][$cuenta2]=$credito;
										$cuenta2++;
									}
								}
						}
					
				}
				$cuenta2=0;
				$cuenta++;
			}
			
			if(isset($arreglo2)){
			$this->Session->write('info', $arreglo2);
			}
			$this->set('info',$arreglo2);
	}
	}
	
	function exportar(){
		if($this->Session->check('User')){
			if($this->Session->check('info')){
				ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
				$this->autoRender=false;
				//create a file
				$filename = "creditosnuevos_".date("Y-m-d").".csv";
				$csv_file = fopen('php://output', 'w');
			
				header('Content-type: application/csv');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
			
				$results = $this->Session->read('info');
				// The column headings of your .csv file
				$header_row = array("#", "Empresa", "#(Empresa)", "Nombre", "Fecha", "Tasa Anual", "Periodo Cuotas", "Tiempo en Meses", "Monto");
				fputcsv($csv_file,$header_row,',','"');
			
				// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
					$total = 0;
					$j = 1; 
				foreach($results['Empresa'] as $empresa):
					$i = 1;
					$total_empresa = 0;
					// Array indexes correspond to the field names in your db table(s)
					$row = array(
						" ",
						$empresa['nombre_empresa'],
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" "
					);
					fputcsv($csv_file,$row,',','"');
					
					if(isset($empresa['Cliente'])):
						foreach($empresa['Cliente'] as $cliente):
							$prestamo=number_format($cliente['Credito']['prestamo'],2);
							$total=$total+$cliente['Credito']['prestamo'];
							switch($cliente['Credito']['periodo_cuotas']){
								case 'diario':
											$divisor=30;
										break;
										case 'semanal':
											$divisor=4;
										break;
										case 'quincenal':
											$divisor=2;
										break;
										case 'mensual':
											$divisor=1;
										break;
							};
							$total_empresa = $total_empresa + round($cliente['Credito']['prestamo'], 2);
							$row = array(
								$j++,
								" ",
								$i++,
								$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'],
								$cliente['Credito']['fecha'],
								$cliente['Credito']['tasa_interes'].'%',
								$cliente['Credito']['periodo_cuotas'],
								$cliente['Credito']['cuotas']/$divisor,
								"$".$prestamo
							);
							fputcsv($csv_file,$row,',','"');
						endforeach;	
					endif;
					$row = array(
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						"Total " . $empresa['nombre_empresa'],
						"$". number_format($total_empresa, 2)
					);
					fputcsv($csv_file,$row,',','"');
				endforeach;
				
				
				fclose($csv_file);
				
			}
		}
	}
	
	function creditoshistorico(){
		if($this->Session->check('User')){
		$empresas=$this->Empresa->find('all');
		$cuenta=0;
		$cuenta2=0;
		foreach($empresas as $empresa){
				$arreglo2['Empresa'][$cuenta]['nombre_empresa']=$empresa['Empresa']['nombre'];
			foreach($empresa['Cliente'] as $cliente){
				$creditos=$this->Empresa->Cliente->Credito->find('all',array('conditions'=>array('Credito.cliente_id'=>$cliente['id'])));
				foreach($creditos as $credito){
				$fecha=explode('-',$credito['Credito']['fecha']);
				$mes=date('n',mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]));
				
					$arreglo2['Empresa'][$cuenta]['Cliente'][$cuenta2]=$credito;
					$cuenta2++;
				}
				
			}
			$cuenta2=0;
			$cuenta++;
		}
		$this->Session->write('historico', $arreglo2);
		$this->set('info',$arreglo2);
	}
	}
	
	function exportarhistorico(){
		if($this->Session->check('User')){
			if($this->Session->check('historico')){
				ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
				$this->autoRender=false;
				//create a file
				$filename = "creditos_histórico_".date("Y-m-d").".csv";
				$csv_file = fopen('php://output', 'w');
			
				header('Content-type: application/csv');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
			
				$info = $this->Session->read('historico');
				// The column headings of your .csv file
				$header_row = array("Empresa", "#", "Nombre", "Fecha", "Tasa Anual", "Periodo Cuotas", "Tiempo en Meses", "Monto");
				fputcsv($csv_file,$header_row,',','"');
				$total=0;
				$c=0;
				foreach($info['Empresa'] as $empresa):
					$total_empresa = 0 ;
					$row = array(
						$empresa['nombre_empresa'],
						" ",
						" ",
						" ",
						" ",
						" ",
						" "
					);
					fputcsv($csv_file,$row,',','"');
					
					foreach($empresa['Cliente'] as $cliente):
						$c=$c+1;
						$prestamo=number_format($cliente['Credito']['prestamo'],2);
						$total=$total+$cliente['Credito']['prestamo'];
						$total_empresa=$total_empresa+$cliente['Credito']['prestamo'];
						switch($cliente['Credito']['periodo_cuotas']){
							case 'diario':
										$divisor=30;
									break;
									case 'semanal':
										$divisor=4;
									break;
									case 'quincenal':
										$divisor=2;
									break;
									case 'mensual':
										$divisor=1;
									break;
						}
						$row = array(
						" ",
						$c,
						$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'],
						$cliente['Credito']['fecha'],
						$cliente['Credito']['tasa_interes'].'%',
						$cliente['Credito']['periodo_cuotas'],
						$cliente['Credito']['cuotas']/$divisor,
						'$' . $prestamo
						);
						fputcsv($csv_file,$row,',','"');
						
					endforeach;
					$row = array(
						"Total de la empresa:",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						"$" . number_format($total_empresa,2)
					);
					fputcsv($csv_file,$row,',','"');
					
				endforeach;
				
				$row = array(
						"Total:",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						"$" . number_format($total,2)
					);
				fputcsv($csv_file,$row,',','"');
				
				fclose($csv_file);
				
			}
		}
		
	}
	
	// function reportetotal(){
		// if($this->Session->check('User')){
		// $empresas=$this->Empresa->find('all');
		// $cuenta=0;
		// $cuenta2=0;
// 		
		// if(!empty($this->data)){
				// $fecha_inicio=new DateTime($this->data['Empresa']['fecha_inicio']['year'] . '-' . $this->data['Empresa']['fecha_inicio']['month']. '-' . $this->data['Empresa']['fecha_inicio']['day'] );
				// $fecha_final=new DateTime($this->data['Empresa']['fecha_final']['year'] . '-' . $this->data['Empresa']['fecha_final']['month'] . '-' . $this->data['Empresa']['fecha_final']['month']);
// 				
			// }else{
				// $fecha_inicio=new DateTime(date('Y') . '-' . date('m') . '-01');
				// $fecha_final=new DateTime(date('Y') . '-' . date('m') . '-' . date('t'));				
		// }
// 		
		// foreach($empresas as $empresa){
				// $arreglo2['Empresa'][$cuenta]['nombre_empresa']=$empresa['Empresa']['nombre'];
			// foreach($empresa['Cliente'] as $cliente){
				// $arreglo2['Empresa'][$cuenta]['Cliente'][$cuenta2]=$this->Empresa->Cliente->Credito->find('all',array('conditions'=>array('Credito.cliente_id'=>$cliente['id']	)));
				// $cuenta2++;
			// }
			// $cuenta2=0;
			// $cuenta++;
		// }
		// $cuenta=0;
		// $cuenta2=0;
// 		
		// foreach($arreglo2['Empresa'] as $empresa){
			// foreach($empresa['Cliente'] as $cliente){
				// $cuentacreditos=0;
				// foreach($cliente as $credito){
							// $cuentapagos=0;
							// $cuentames=0;
// 				
						// foreach($credito['Pago'] as $pago){
// 							
							// if($pago['sitacion']=='Pagado'){
								// $cuentapagos++;
								// $fecha=new DateTime($pago['fecha_pagado']);
								// $comparacion1=$fecha_inicio->diff($fecha);
								// $comparacion2=$fecha->diff($fecha_final);
								// if($comparacion1->format('%R%a')>=0 and $comparacion2->format('%R%a')>=0){
									// $cuentames++;
								// }
							// }
						// }
					// $arreglo2['Empresa'][$cuenta]['Cliente'][$cuenta2][$cuentacreditos]['Credito']['pago_actual']=$cuentapagos;
					// $arreglo2['Empresa'][$cuenta]['Cliente'][$cuenta2][$cuentacreditos]['Credito']['pago_mes']=$cuentames;
					// $cuentacreditos++;
// 					
				// }
				// $cuenta2++;
			// }
// 			
			// $cuenta++;
			// $cuenta2=0;
		// } 		
		// $this->set('arreglo2',$arreglo2);
	// }
	// }

	function reporteCartera(){
		if(!empty($this->data)){
				$fecha_inicio=new DateTime($this->data['Empresa']['fecha_inicio']);
				$fecha_final=new DateTime($this->data['Empresa']['fecha_final']);
				
			}else{
				$fecha_inicio=new DateTime(date('Y') . '-' . date('m') . '-01');
				$fecha_final=new DateTime(date('Y') . '-' . date('m') . '-' . date('t'));				
		}
			
		$creditos = $this->Empresa->Cliente->Credito->find('all',array('recursive' => 2, 'order' => 'Cliente.empresa_id ASC'));
		
			foreach($creditos as $credito){
				foreach($credito['Pago'] as $pago){
					if($pago['sitacion'] == 'Pagado' || $pago['sitacion'] == 'abono' ){
						if($pago['fecha_pagado'] != null && $pago['fecha_pagado'] != 0){
							$fecha = new DateTime($pago['fecha_pagado']);
							$comparacion1=$fecha_inicio->diff($fecha);
							$comparacion2=$fecha->diff($fecha_final);
							if($comparacion1->format('%R%a')>=0 and $comparacion2->format('%R%a')>=0){
								$arreglo[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['nombre']. ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno']][$credito['Credito']['id']][] = $pago;
							}
						}
					}
				}
			}
		
		foreach($arreglo as $empresa => $clientes){
			foreach($clientes as $nombre =>$creditos){
				foreach($creditos as $id => $pagos){
				
						$capital_mes = 0;
						$letra_mes = 0;
						$iva_mes = 0;
						$interes_mes = 0;
						$pagos_mes = 0;
						$ultimo_pago = 0;
						
						foreach($pagos as $pago){
							
							$numero_pago = explode('/', $pago['numero_pago']);
							
							
							
							if($pago['sitacion'] == 'abono' || ($pago['sitacion'] == 'Liquidado' && $pago['Abono'] != null)){
								
								foreach($pago['Abono'] as $abono){
									$capital_mes = $capital_mes + $abono['abono'];
								}
		
							}else{
								
								if($ultimo_pago<$numero_pago[0]){
								
								$ultimo_pago = $numero_pago[0];
								
								}
							
								$pagos_mes++;
								$capital_mes = $capital_mes + $pago['pago_capital'];
								$interes_mes = $interes_mes + $pago['intereses'];
								$iva_mes = $iva_mes + $pago['iva_intereses'];
									
							}	
							
						}
						
						
						switch($pagos[0]['Credito']['periodo_cuotas']){
							case 'semanal':
								$informacion[$empresa][$nombre][$id]['tiempo'] = round($pagos[0]['Credito']['cuotas']/2);
								break;
							case 'quincenal':
								$informacion[$empresa][$nombre][$id]['tiempo'] = $pagos[0]['Credito']['cuotas'];
								break;
							case 'mensual':
								$informacion[$empresa][$nombre][$id]['tiempo'] = $pagos[0]['Credito']['cuotas']/4.333;
								break;
						}
						
						if($ultimo_pago != 'liquidacion'){
							$ultimo_pago = $ultimo_pago . '/' . $pagos[0]['Credito']['cuotas'];
						}
						
						$informacion[$empresa][$nombre][$id]['capital/mes'] = $capital_mes;
						$informacion[$empresa][$nombre][$id]['letra/mes'] = $capital_mes + $interes_mes + $iva_mes;
						$informacion[$empresa][$nombre][$id]['interes/mes'] = $interes_mes;
						$informacion[$empresa][$nombre][$id]['iva/mes'] = $iva_mes;
						$informacion[$empresa][$nombre][$id]['pagos/mes'] = $pagos_mes;
						$informacion[$empresa][$nombre][$id]['pago/actual'] = $ultimo_pago;
						$informacion[$empresa][$nombre][$id]['tasa'] = $pagos[0]['Credito']['tasa_interes'] . '%';
						$informacion[$empresa][$nombre][$id]['periodo_cuotas'] = $pagos[0]['Credito']['periodo_cuotas'];
						$informacion[$empresa][$nombre][$id]['cuotas'] = $pagos[0]['Credito']['cuotas'];
						$informacion[$empresa][$nombre][$id]['prestamo'] = $pagos[0]['Credito']['prestamo'];
						$informacion[$empresa][$nombre][$id]['estado'] = $pagos[0]['Credito']['estado'];
						$informacion[$empresa][$nombre][$id]['pago'] = $pagos[0]['pago'];
						
				
				}
			}
		}
		$this->Session->write('cartera', $informacion);
		$this->set('informacion', $informacion);
	}
	
	function exportar_cartera(){
		if($this->Session->check('User')){
			if($this->Session->check('cartera')){
				ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
				$this->autoRender=false;
				//create a file
				$filename = "reporteCartera_".date("Y-m-d").".csv";
				$csv_file = fopen('php://output', 'w');
			
				header('Content-type: application/csv');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
			
				$cartera = $this->Session->read('cartera');
				// The column headings of your .csv file
				$header_row = array("Empresa", "#", "Nombre", "Tasa", "Periodo Cuotas", "Tiempo (mes)", "Prestamo", "Estado", "Pago actual", "Pago realizado", "Letra", "Capital/mes", "Interes/mes", "Iva/mes", "Letra/mes");
				fputcsv($csv_file,$header_row,',','"');
			
				// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
				foreach($cartera as $empresa => $clientes):
					$i = 1;
					$row = array(
						$empresa,
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" "
					);
					fputcsv($csv_file,$row,',','"');
					
					$total_capital = 0;
					$total_interes = 0;
					$total_iva = 0;
					$total_letra = 0; 
					foreach($clientes as $cliente => $creditos):
						foreach($creditos as $credito_id => $pago):
							$total_capital = $total_capital + round($pago['capital/mes'], 2);
							$total_interes = $total_interes + round($pago['interes/mes'], 2);
							$total_iva = $total_iva + round($pago['iva/mes'], 2);
							$total_letra = $total_letra + round($pago['letra/mes'], 2);
							$row = array(
								" ",
								$i++,
								$cliente,
								$pago['tasa'],
								$pago['periodo_cuotas'],
								number_format($pago['tiempo'], 2),
								"$" . number_format($pago['prestamo'], 2),
								$pago['estado'],
								str_replace('/', ' de ', $pago['pago/actual']),
								$pago['pagos/mes'],
								"$" . number_format($pago['pago'], 2),
								"$" . number_format($pago['capital/mes'], 2),
								"$" . number_format($pago['interes/mes'], 2),
								"$" . number_format($pago['iva/mes'], 2),
								"$" . number_format($pago['letra/mes'],2)
							
							);
							
							fputcsv($csv_file,$row,',','"');
							
						endforeach;
					endforeach;
					
					$row = array(
						"Total" . $empresa . ":",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						"$" . number_format($total_capital, 2),
						"$" . number_format($total_interes, 2),
						"$" . number_format($total_iva, 2),
						"$" . number_format($total_letra, 2)
					);
					
					fputcsv($csv_file,$row,',','"');
							
				endforeach;
				
				
				fclose($csv_file);
				
			}
		}
	}
	
	}

?>
