<?php

class CreditosController extends AppController{
		var $name='Creditos';
		var $helpers=array('Html','Form');
		
		function historial($id=null){
			if($this->Session->check('User')){
				$this->layout = 'template';
				$this->Credito->Behaviors->attach('Containable');
				$creditos = $this->Credito->find('all', array(
					'conditions' => array(
						'Credito.cliente_id' => $id
					),
					'contain' => array('Cliente' => array('fields' => array('full_name')))
				));
				$this->set('title_for_layout', '');
				$this->set(compact('creditos'));
			}
		}
		
		function creditosterminados(){
			if($this->Session->check('User')){
				$creditos=$this->Credito->find('all',array('conditions'=>array('Credito.estado'=>'finalizado')));
				$this->Session->write('terminados', $creditos);
				$this->set('creditos',$creditos);
			}
		}
		
		function exportarterminados(){
			if($this->Session->check('User')){
				if($this->Session->check('terminados')){
					App::import('Vendor', 'format');
					$format = new format();
					ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
					$this->autoRender=false;
					//create a file
					$filename = "creditos_terminados_".date("Y-m-d").".csv";
					$csv_file = fopen('php://output', 'w');
				
					header('Content-type: application/csv');
					header('Content-Disposition: attachment; filename="'.$filename.'"');
				
					$creditos = $this->Session->read('terminados');
					// The column headings of your .csv file
					$header_row = array("Nombre", "Número de Crédito", "Fecha", "Monto", "Número de Cuotas", "Periodo Cuotas");
					fputcsv($csv_file,$header_row,',','"');
					foreach($creditos as $credito):
						$row = array(
							$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'],
							$credito['Credito']['id'],
							$format->fecha($credito['Credito']['fecha_calculo']),
							"$" . number_format($credito['Credito']['prestamo'],2),
							$credito['Credito']['cuotas'],
							$credito['Credito']['periodo_cuotas']
							
						);
						fputcsv($csv_file,$row,',','"');
					endforeach;
					fclose($csv_file);
				}
				
			}
			
		}
		
		function sesioncapital($id=null){
			if($this->Session->check('User')){
				$this->Session->write('datos_credito',$this->Credito->find('first',array('recursive'=>-1,'conditions'=>array('Credito.id'=>$id))));
				$this->redirect(array('controller'=>'pagos','action'=>'capital',$id));
			}
		}
		
		function reporte(){
			if($this->Session->check('User')){
			if($this->Session->check('arreglo')){
				$arreglo=$this->Session->read('arreglo');
				$i=0;
				$total=0;
				$total_capital=0;
				$total_iva=0;
				$total_interes=0;
				foreach($arreglo as $pago){
					if($pago['sitacion']=='Pagado'){
					$credito=$this->Credito->find('first',array('conditions'=>array('Credito.id'=>$pago['credito_id'])));
					$tabla[$i]=array('cheque'=>$credito['Credito']['cheque'],
									'nombre'=>$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'],
									'fecha'=>$pago['fecha'],
									'fecha_pagado'=>$pago['fecha_pagado'],
									'numero_pago'=>$pago['numero_pago'],
									'retencion'=>$pago['pago'],
									'capital'=>$pago['pago_capital'],
									'interes'=>$pago['intereses'],
									'iva'=>$pago['iva_intereses']);
					$total=$total+$pago['pago'];
					$total_capital=$total_capital+$pago['pago_capital'];
					$total_iva=$total_iva+$pago['iva_intereses'];
					$total_interes=$total_interes+$pago['intereses'];
					$i++;
					}
				}
				$totales=array('total'=>$total,'total_capital'=>$total_capital,'total_iva'=>$total_iva,'total_interes'=>$total_interes);
				$this->set('tabla',$tabla);
				$this->set('totales',$totales);
				Configure::write('debug',0); // Otherwise we cannot use this method while developing 
       				 $this->layout = 'pdf'; //this will use the pdf.ctp layout 
       				 $this->render();
			}
			}
		}
		
		function borrarcredito($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$this->Credito->id=$id;
			$credito=$this->Credito->read();
			foreach($credito['Pago'] as $pago){
				if($pago['sitacion']=='Pagado'){
					$bandera=1;
				}else{
					$bandera=0;
					break;
				}
			}
			if($bandera==1){
			if($this->Credito->saveField('estado','finalizado')){
				$this->Session->setFlash('Su información se ha actualizado con éxito');
				$this->redirect(array('controller'=>'clientes','action'=>'view2',$usuario['User']['id']));
			}
			}else{
				$this->Session->setFlash('Este crédito aún no ha concluido');
				$this->redirect(array('action'=>'view',$credito['Cliente']['id']));
			}
			}
		}
		
		function view($id=null){
			if($this->Session->check('User')){
				$this->layout = 'template';
				$this->Credito->Behaviors->attach('Containable');

				$credito = $this->Credito->find('first', array(
					'conditions' => array(
						'Credito.estado' => 'activo',
						'Credito.cliente_id' => $id
					),
					'contain' => array('Pago', 'Cliente')
				));

				if($credito != null){
					$this->set(compact('credito'));
					$this->set('title_for_layout', '');
				}else{
					$cliente = $this->Credito->Cliente->find('first', array(
						'conditions' => array(
							'Cliente.id' => $id
						),
						'contain' => false
					));

					$this->Session->write('Cliente', $cliente);
					$this->redirect(array('action' => 'add'));
				}
			}
		}

		function view_credit($id = null){
			if($this->Session->check('User')){
				$this->layout = 'template';
				$this->Credito->Behaviors->attach('Containable');

				$credito = $this->Credito->find('first', array(
					'conditions' => array(
						'Credito.id' => $id
					),
					'contain' => array('Pago', 'Cliente')
				));

				$this->set(compact('credito', 'id'));
			}
		}
		
		function add(){
			if($this->Session->check('User')){
				$this->layout = 'template';
				$usuario=$this->Session->read('User');
				$cliente=$this->Session->read('Cliente');
				if(!empty($this->data)){
					$creditosActivos = $this->Credito->find('count', array(
						'conditions' => array(
							'Credito.cliente_id' => $cliente['Cliente']['id'],
							'Credito.estado' => 'activo'
						)
					));
					
					if($creditosActivos == 0){
						//pr($this->data);exit;
						switch($this->data['Credito']['periodo_cuotas']){
							case 'diario':
								$this->data['Credito']['cuotas'] = round($this->data['Credito']['cuotas']*30.4166, 0, PHP_ROUND_HALF_UP);
							break;
							case 'semanal':
								$this->data['Credito']['cuotas'] = round($this->data['Credito']['cuotas']*4,0,PHP_ROUND_HALF_UP);
								break;
							case 'quincenal':
								$this->data['Credito']['cuotas'] = $this->data['Credito']['cuotas']*2;
								break;
							case 'mensual':
								$this->data['Credito']['cuotas'] = $this->data['Credito']['cuotas'];
								break;
						}

						$fecha=explode('/',$this->data['Credito']['fecha']);
						$this->data['Credito']['fecha']=$fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
						$fecha=explode('/',$this->data['Credito']['fecha_calculo']);
						$this->data['Credito']['fecha_calculo']=$fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
						$this->data['Credito']['cliente_id']=$cliente['Cliente']['id'];
						// pr($this->data);exit;
						if($this->Credito->save($this->data)){
							$this->Session->setFlash('Su información se ha guardado con éxito.');
							$this->redirect(array('action'=>'imprimir',$this->data['Credito']['cliente_id']));
						}
					}else{
						$this->Session->setFlash('Este cliente ya cuenta con un crédito activo');
						$this->redirect(array(
							'controller' => 'creditos',
							'action' => 'view',
							$cliente['Cliente']['id']
							
						));
					}
				}else{
					$this->set('id',$cliente['Cliente']['id']);
					$this->set('nombre',$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno']);
				}
			}
		}

		function imprimir($id=null){
			if($this->Session->check('User')){
				$usuario=$this->Session->read('User');
				$credito=$this->Credito->find('first',array('conditions'=>array('Credito.cliente_id'=>$id,'Credito.estado'=>'activo')));
					$this->Session->write('credito',$credito);
					$this->redirect(array('controller'=>'pagos','action'=>'add'));
		
		
			}
		}
		
		function imprimirContrato($id = null) {
			if($this->Session->check('User')){ 
       			 $credito=$this->Credito->find('first',array('conditions'=>array('Credito.id'=>$id)));
					switch($credito['Credito']['periodo_cuotas']){
						case "semanal":
							$periodo='SEMANALES';
							$vencimiento='el fin de semana próximo al día siguiente que se hizo el préstamo';
							$vencimiento2='el fin de semana próximo';
							$exigir='cada siguiente semana';
							$mente='SEMANALMENTE';
							$ese='semanas';
							$vencimiento3='de acuerdo a lo que se menciona arriba. Semanal';
							break;
						case "quincenal":
							$periodo='QUINCENALES';
							$vencimiento='el día 15 o el día ultimo del mes en el que se hizo el Préstamo';
							$vencimiento2='el primer día del mes';
							$exigir='cada siguiente día 15 o día ultimo del mes.';
							$mente='QUINCENALMENTE';
							$ese='quincenas';
							$vencimiento3='de acuerdo a lo que se menciona arriba los días quince y último de cada mes.';
							break;
						case "diario":
							$periodo='DIARIOS';
							$vencimiento='el día siguiente en el que se hizo el Préstamo';
							$vencimiento2='el día siguiente';
							$exigir='cada siguiente día.';
							$mente='DIARIAMENTE';
							$ese='dias';
							$vencimiento3='de acuerdo a lo que se menciona arriba. Diario';
							break;
						case "mensual":
							$periodo='MENSUALES';
							$vencimiento='el fin de mes próximo al día siguiente que se hizo el préstamo';
							$vencimiento2='el fin de mes próximo';
							$exigir='cada siguiente mes';
							$mente='MENSUALMENTE';
							$ese='meses';
							$vencimiento3='de acuerdo a lo que se menciona arriba. Mensual';
							break;
					}
						
					App::import('Vendor','numeros');
					if($credito['Credito']['cheque']=='efectivo' or $credito['Credito']['cheque']=='Efectivo' or $credito['Credito']['cheque']=='EFECTIVO'){
						$forma_pago='efectivo';
					}else{
						$forma_pago='cheque';
					}
					$numeros=new numeros();
					$letras_prestamo=$numeros->numtoletras($credito['Credito']['prestamo']);
					$letras_pago=$numeros->numtoletras(round($credito['Pago'][0]['pago']*100)/100);
					$letras_tasa=explode('PESOS',$numeros->numtoletras($credito['Credito']['tasa_interes']));
					$letras_tasa=strtolower($letras_tasa[0]);
					$this->set('forma_pago',$forma_pago);
					$this->set('letras_tasa',$letras_tasa);
					$this->set('credito',$credito);
					$this->set('letras_prestamo',$letras_prestamo);
					$this->set('ese',$ese);
					$this->set('letras_pago',$letras_pago);
					$this->set('periodo',$periodo);
					$this->set('vencimiento',$vencimiento);
					$this->set('vencimiento2',$vencimiento2);
					$this->set('vencimiento3',$vencimiento3);
					$this->set('mente',$mente);
					$this->set('exigir',$exigir);
        			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
       				 $this->layout = 'pdf'; //this will use the pdf.ctp layout 
       				 $this->render();
	       	} 
	    }
		
		function cotizar(){
			if($this->Session->check('User')){
				$this->layout = 'template';
				$this->set('title_for_layout', 'Cotizar Crédito');
				if(!empty($this->data)){
					$total_iva=0;
					$total_pago=0;
					$total_interes=0;
					$total_capital=0;
					$num_mes=array('31','28','31','30','31','30','31','31','30','31','30','31');
					$fechas = explode('/', $this->data['Credito']['fecha_cotizacion']);
					$dia = $fechas[0];
					$mes = $fechas[1];
					$anio = $fechas[2];
					$prestamo=$this->data['Credito']['prestamo'];
					
					if($this->data['Credito']['periodo_cuotas']=='diario'){
						$tasa=$this->data['Credito']['tasa_interes']/100;
						$tasa=$tasa/360;
						$cuotas = round($this->data['Credito']['cuotas']*30.4166, 0, PHP_ROUND_HALF_UP);
						
					}
					if($this->data['Credito']['periodo_cuotas']=='semanal'){
						$tasa=$this->data['Credito']['tasa_interes']/100;
						$tasa=$tasa/360;
						$tasa=$tasa*7;
						$cuotas = round($this->data['Credito']['cuotas']*4, 0, PHP_ROUND_HALF_UP);
					}
					if($this->data['Credito']['periodo_cuotas']=='quincenal'){
						$tasa=$this->data['Credito']['tasa_interes']/100;
						$tasa=$tasa/12;
						$tasa=$tasa/2;
						$cuotas = $this->data['Credito']['cuotas']*2;
					}
					if($this->data['Credito']['periodo_cuotas']=='mensual'){
						$tasa=$this->data['Credito']['tasa_interes']/100;
						$tasa=$tasa/12;
						$cuotas = $this->data['Credito']['cuotas'];
					}
					
					if($this->data['Credito']['tipo_calculo'] == 'insoluto'){
						$tasa = $tasa * 1.16;
						$pago = $prestamo*($tasa*pow((1+$tasa),$cuotas)/(pow((1+$tasa),$cuotas)-1));
					}else{ 
						$pago = $prestamo/$cuotas;
					}
					
						$saldo = $prestamo;
						$interes = $tasa*$saldo;
						
					$this->data['Credito']['cuotas'] = $cuotas;
					for($cuenta=1;$cuenta<=$cuotas;$cuenta++){
						switch($this->data['Credito']['periodo_cuotas']){
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
							$mes++;
							if($mes==13){
								$mes=1;
								$anio++;
							};
							break;
						case "anual":
							$anio++;
							break;}
								
						if($this->data['Credito']['tipo_calculo'] == 'insoluto'){
							$saldo=$saldo-$pago+$interes;
							$arreglo['Pago'][$cuenta-1]['intereses']=($interes/1.16);
							$arreglo['Pago'][$cuenta-1]['pago_capital']=$pago-$interes;
							$arreglo['Pago'][$cuenta-1]['iva_intereses']=.16*($interes/1.16);
							$arreglo['Pago'][$cuenta-1]['pago']=$pago;
							$arreglo['Pago'][$cuenta-1]['saldo_insoluto']=$saldo;
							$total_interes=$total_interes+($interes/1.16);
							$interes = $saldo*$tasa;
							
						}else{
							$saldo=$saldo-$pago;
							$arreglo['Pago'][$cuenta-1]['intereses']=$interes;
							$arreglo['Pago'][$cuenta-1]['pago_capital']=$pago;
							$arreglo['Pago'][$cuenta-1]['iva_intereses']=$interes*.16;
							$arreglo['Pago'][$cuenta-1]['pago']=$pago+$interes*1.16;
							$arreglo['Pago'][$cuenta-1]['saldo_insoluto']=$saldo;
							$total_interes=$total_interes+$interes;
						}
							$arreglo['Pago'][$cuenta-1]['numero_pago']=$cuenta.'/'.$this->data['Credito']['cuotas'];
						
						$total_pago=$total_pago+$arreglo['Pago'][$cuenta-1]['pago'];
						$total_iva=$total_iva+$arreglo['Pago'][$cuenta-1]['iva_intereses'];
						$total_capital = $arreglo['Pago'][$cuenta-1]['pago_capital'] + $total_capital;
						$arreglo['Pago'][$cuenta-1]['fecha'] = date('d-m-Y', strtotime($dia . "-" . $mes . "-" . $anio));
					
					}
					$this->data['Credito']['total_capital']=$total_capital;
					$this->data['Credito']['total_pago']=$total_pago;
					$this->data['Credito']['total_iva']=$total_iva;
					$this->data['Credito']['total_interes']=$total_interes;
					$this->Session->write('arreglo',$arreglo);
					$this->Session->write('credito',$this->data);
					$this->redirect(array('action'=>'ver_cotizacion'));
				}

			}
		}

		function ver_cotizacion(){
			if($this->Session->check('User')){
				if($this->Session->check('arreglo')){
					$this->layout = 'template';
					$arreglo=$this->Session->read('arreglo');
					$credito=$this->Session->read('credito');
					$this->set('credito',$credito);
					$this->set('arreglo',$arreglo);
				}
			}
		}
		
		function pdfcotizar(){
			if($this->Session->check('User')){
				if($this->Session->check('arreglo')){
					$arreglo=$this->Session->read('arreglo');
					$credito=$this->Session->read('credito');
				Configure::write('debug',0); // Otherwise we cannot use this method while developing 
				$this->set('arreglo',$arreglo);
				$this->set('credito',$credito);
		        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		        $this->render(); 
				}
			}
					
		}

		function liquidar($id = null, $id2 = null){
			if($this->Session->check('User')){
				$this->loadModel('Abono');
				$this->Credito->Behaviors->attach('Containable');
				$credito = $this->Credito->find('first', array(
					'conditions' => array(
						'Credito.id' => $id
					),
					'contain' => array(
						'Cliente' => array(
							'Empresa'
						)
					)
				));
			
				$pagos = $this->Credito->Pago->find('all', array(
					'conditions' => array(
					'Pago.credito_id' => $id,
					"(`Pago`.`sitacion` = 'No pagado' OR `Pago`.`sitacion` = 'abono')"
					),
					'order' => array('Pago.created ASC'),
					'recursive' => 1
				));
				
					$cuenta = 0;
					$totalabono = 0;
					$totalpago = 0;
					$saldo = 0;
						
				foreach($pagos as $pago){
					
					unset($pago['Pago']['created']);
					unset($pago['Pago']['modified']);
					
					if($pago['Pago']['saldo_pago'] != null){
					
						$totalpago = $totalpago + $pago['Pago']['saldo_pago'];
						
					}else{
						$totalpago = $totalpago + $pago['Pago']['pago'];
					}
					
					$pago['Pago']['sitacion'] = 'Pagado';
					$arreglo[$cuenta] = $pago;
					$cuenta++;
				}

				$fecha=date('d-m-Y');
				
				$this->Abono->Cobro->create();
				$this->Abono->Cobro->save(array(
					'empresa_id' => $credito['Cliente']['Empresa']['id'],
					'fecha' => date('Y-m-d')
				));
				$id = $this->Abono->Cobro->id;
				$this->Abono->create();
				$this->Abono->save(array(
					'cliente_id' => $credito['Cliente']['id'],
					'cobro_id' => $id,
					'abono' => round($totalpago, 2)
				));

				$abono_id = $this->Abono->id;

				foreach($pagos as $pago){

					if($pago['Pago']['saldo_pago'] != null){
					
						$totalpago = $pago['Pago']['saldo_pago'];
						
					}else{
						$totalpago = $pago['Pago']['pago'];
					}

					$this->Abono->Asociation->create();
					$this->Abono->Asociation->save(array(
						'pago_id' => $pago['Pago']['id'],
						'abono_id' => $abono_id,
						'abono' => round($totalpago, 2)
					));
				}

				$this->Credito->Pago->saveAll($arreglo);
				$this->Credito->id = $credito['Credito']['id'];
				$this->Credito->saveField('estado', 'finalizado');
				
				$this->Session->setFlash('El crédito se ha finalizado');
				$this->redirect(array('controller' => 'cobros', 'action' => 'view', $id));
				
				
			}
			
		}

		function pdfliquidar($id = null){
			if($this->Session->check('User')){
				$pagos= $this->Credito->Pago->find('all', array(
					'conditions' => array('Pago.credito_id' => $id),
					'recursive' => -1
				));
				$credito = $this->Credito->find('first', array(
					'conditions' => array('Credito.id', $id)
				));
				
				$totales['total_capital']=0;
				$totales['total_pago']=0;
				$totales['total_interes']=0;
				$totales['total_iva']=0;
				
				foreach($pagos as $pago){
					$totales['total_capital'] = $total['total_capital'] + $pago['Pago']['pago_capital'];
					$totales['total_pago'] = $total['total_pago'] + $pago['Pago']['pago'];
					$totales['total_interes'] = $total['total_interes'] + $pago['Pago']['intereses'];
					$totales['total_iva'] = $total['total_iva'] + $pago['Pago']['iva_intereses'];
				}
				
				$this->set('totales', $totales);
				$this>set('pagos', $pagos);
				$this->set('credito',$credito);
				Configure::write('debug',0); // Otherwise we cannot use this method while developing 
       				 $this->layout = 'pdf'; //this will use the pdf.ctp layout 
       				 $this->render();
			}
		}
		
		function contrato($id = null){
			if($this->Session->check('User')){ 
       			 $credito=$this->Credito->find('first',array('conditions'=>array('Credito.id'=>$id),'recursive' => 2));
					switch($credito['Credito']['periodo_cuotas']){
						case "semanal":
							$periodo_plural='SEMANALES';
							$vencimiento='el fin de semana próximo al día siguiente que se hizo el préstamo';
							$vencimiento2='el fin de semana próximo';
							$exigir='cada siguiente semana';
							$mente='SEMANALMENTE';
							$plural='SEMANAS';
							$incremento_pagos='DE ACUERDO A LO QUE SE MENCIONA ARRIBA, SEMANAL';
							break;
						case "quincenal":
							$periodo_plural='QUINCENALES';
							$vencimiento='el día 15 o el día ultimo del mes en el que se hizo el Préstamo';
							$vencimiento2='el primer día del mes';
							$exigir='cada siguiente día 15 o día ultimo del mes.';
							$mente='QUINCENALMENTE';
							$plural='QUINCENAS';
							$incremento_pagos='CADA DÍA ÚLTIMO Y QUINCE DE CADA MES EN MISMO DÍA CALENDARIO DE CADA MES SUCESIVO';
							break;
						case "diario":
							$periodo_plural='DIARIOS';
							$vencimiento='el día siguiente en el que se hizo el Préstamo';
							$vencimiento2='el día siguiente';
							$exigir='cada siguiente día.';
							$mente='DIARIAMENTE';
							$plural='DIAS';
							$incremento_pagos='DE ACUERDO A LO QUE SE MENCIONA ARRIBA, DIARIO';
							break;
						case "mensual":
							$periodo_plural='MENSUALES';
							$vencimiento='el fin de mes próximo al día siguiente que se hizo el préstamo';
							$vencimiento2='el fin de mes próximo';
							$exigir='cada siguiente mes';
							$mente='MENSUALMENTE';
							$plural='MESES';
							$incremento_pagos='DE ACUERDO A LO QUE SE MENCIONA ARRIBA, MENSUAL';
							break;
					}
						
					App::import('Vendor','numeros');
					
					if($credito['Credito']['cheque']=='efectivo' or $credito['Credito']['cheque']=='Efectivo' or $credito['Credito']['cheque']=='EFECTIVO'){
						$forma_pago='efectivo';
					}else{
						$forma_pago='cheque';
					}
					
					$total_interes = 0;
					foreach($credito['Pago'] as $pago){
						$total_interes = $total_interes + $pago['intereses'];
					}
					$usuario = $this->Session->read('User');
					$numeros=new numeros();
					$letras_prestamo=$numeros->numtoletras($credito['Credito']['prestamo']);
					$letras_pago=$numeros->numtoletras(round($credito['Pago'][0]['pago']*100)/100);
					$letras_tasa=explode('PESOS',$numeros->numtoletras($credito['Credito']['tasa_interes']));
					$letras_tasa=strtolower($letras_tasa[0]);
					$letras_total = $numeros->numtoletras(round(round($credito['Pago'][0]['pago'],2)*$credito['Credito']['cuotas'], 2));
					$this->set('total_interes', $total_interes);
					$this->set('usuario', $usuario);
					$this->set('plural',$plural);
					$this->set('forma_pago',$forma_pago);
					$this->set('letras_tasa',$letras_tasa);
					$this->set('credito',$credito);
					$this->set('letras_prestamo',$letras_prestamo);
					$this->set('letras_pago',$letras_pago);
					$this->set('periodo_plural',$periodo_plural);
					$this->set('vencimiento',$vencimiento);
					$this->set('vencimiento2',$vencimiento2);
					$this->set('incremento_pagos',$incremento_pagos);
					$this->set('mente',$mente);
					$this->set('exigir',$exigir);
					$this->set('letras_total', $letras_total);
        			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
       				 $this->layout = 'pdf'; //this will use the pdf.ctp layout 
       				 $this->render();
   			 }
   		} 
		
		function view_norma($id=null){
			if($this->Session->check('User')){
				$usuario = $this->Session->read('User');
				$this->Credito->Behaviors->attach('Containable');
				$credito = $this->Credito->find('first',array(
					'conditions'=>array(
						'Credito.cliente_id'=>$id,
						'Credito.estado'=>'activo'
					), 
					'contain' => array('Cliente')
				));
					if($credito){
						$this->Credito->Pago->Behaviors->attach('Containable');
						$pagos=$this->Credito->Pago->find('all',array(
							'conditions'=>array(
								'Pago.credito_id'=>$credito['Credito']['id']
							),
							'contain' => array(
								'Asociation' => array(
									'Abono'
								)
							)
						));
						$totales=null;
							if(!isset($totales[$credito['Cliente']['full_name']])){
								$totales[$credito['Cliente']['full_name']]['Prestamo']=0;
								$totales[$credito['Cliente']['full_name']]['Intereses']=0;
								$totales[$credito['Cliente']['full_name']]['Iva']=0;
							}
						foreach ($pagos as $key => $pago) {
							$totales[$credito['Cliente']['full_name']]['Prestamo']=$totales[$credito['Cliente']['full_name']]['Prestamo'] + $pago['Pago']['pago_capital'];
							$totales[$credito['Cliente']['full_name']]['Intereses']=$totales[$credito['Cliente']['full_name']]['Intereses'] + $pago['Pago']['intereses'];
							$totales[$credito['Cliente']['full_name']]['Iva']=$totales[$credito['Cliente']['full_name']]['Iva'] + $pago['Pago']['iva_intereses'];
						}
						$this->set(compact('credito', 'pagos'));
						$this->set(compact('totales'));
						}else{
						if($id2){
							$mensaje='Este cliente aún no tiene un historial';
						}else{
							$mensaje='Este cliente aún no cuenta con un crédito activo';
						}
					$this->Session->setFlash($mensaje);
					$this->redirect(array('controller'=>'clientes','action'=>'sesion',$id,5));
				}
			}
			 // pr($credito);
			 // pr($pagos);
			 // pr($totales);
		}

		function saldo_creditos(){
			  $this->layout = 'template';
			if(!empty($this->data)){
				$fecha_inicio=date('Y-m-d',strtotime($this->data['Credito']['fecha_inicio']));
				$fecha_final=date('Y-m-d',strtotime($this->data['Credito']['fecha_final']));
			}else{
				if(date('d')>15){
					$fecha_final=date('Y-m-t');
					$fecha_inicio=date('Y-m-16');
				}else{
					$fecha_inicio=date('y-m-1');
					$fecha_final=date('y-m-16');
				}
			}
			$this->Credito->Behaviors->attach('Containable');
			$Creditos = $this -> Credito -> find('all',array(
				'conditions'=>array(
					'credito.estado'=>'activo',
					//'credito.fecha_calculo >='=>$fecha_inicio,
					//'credito.fecha_calculo <='=>$fecha_final,
					'credito.fecha_calculo between (? - interval 1 month) and  (? - interval 0 month)' => array($fecha_inicio, $fecha_final),				
				),
				'contain'=>array(
					'Cliente'=>array(
						'Empresa'=>array(
							'fields'=>array( 
								'nombre' ),					
							'order'=>array('Empresa.nombre')
						)
					),
					'Pago'=>array(
						'Asociation'=>array(
							'Abono'
						)
					)
				)
			));	
		
			$t=null;
			foreach ($Creditos as $key => $credito) {
				
				if(! isset($t[$credito['Cliente']['Empresa']['nombre']])){
					$t[$credito['Cliente']['Empresa']['nombre']]['Capital']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Interes']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Iva']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Pago']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldo']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_inte']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_iva']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['saldointeres']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['saldoiva']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldototal']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_intereses']=0;
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_iva']=0;
				}
				
				$t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC'] = $t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC'] + $credito['Credito']['prestamo'];
						
				foreach ($credito['Pago'] as $key => $Pago){
					foreach($Pago['Asociation'] as $key => $Asociation){
						foreach ($Asociation['Abono'] as $key => $Abono){
							$t[$credito['Cliente']['Empresa']['nombre']]['Capital'] = $t[$credito['Cliente']['Empresa']['nombre']]['Capital'] + $Pago['pago_capital'];	
						}
					} 
					
					if($Pago['sitacion']=='Pagado'){
						
						$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial'] =$credito['Credito']['prestamo'] - $Pago['pago_capital'];
						$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_intereses']= $credito['Credito']['prestamo'] - $Pago['intereses'];
						$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_iva']=$credito['Credito']['prestamo'] - $Pago['iva_intereses'];
						
						$t[$credito['Cliente']['Empresa']['nombre']]['Pago'] = $t[$credito['Cliente']['Empresa']['nombre']]['Pago'] + $Asociation['Abono']['abono'];
					}
					
					if($Pago['sitacion']=='No pagado'){
						$t[$credito['Cliente']['Empresa']['nombre']]['Saldototal']= $t[$credito['Cliente']['Empresa']['nombre']]['Saldototal'] + $Pago['pago_capital'];
					}
					
					$t[$credito['Cliente']['Empresa']['nombre']]['Saldo']=$t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC'] - $t[$credito['Cliente']['Empresa']['nombre']]['Pago'] + $t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial'];
					
					$t[$credito['Cliente']['Empresa']['nombre']]['Interes'] = $t[$credito['Cliente']['Empresa']['nombre']]['Interes'] + $Pago['intereses'];
					$t[$credito['Cliente']['Empresa']['nombre']]['Iva'] = $t[$credito['Cliente']['Empresa']['nombre']]['Iva'] + $Pago['iva_intereses'];
					
					$t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_inte']=$t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC']-$t[$credito['Cliente']['Empresa']['nombre']]['Interes'];
					$t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_iva']=$t[$credito['Cliente']['Empresa']['nombre']]['PrestamoC']-$t[$credito['Cliente']['Empresa']['nombre']]['Iva'];
				   	
				   	$t[$credito['Cliente']['Empresa']['nombre']]['saldointeres']=$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_intereses'] + $t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_inte']
				   		- $t[$credito['Cliente']['Empresa']['nombre']]['Interes'];
					$t[$credito['Cliente']['Empresa']['nombre']]['saldoiva']=$t[$credito['Cliente']['Empresa']['nombre']]['Saldo_inicial_iva'] + $t[$credito['Cliente']['Empresa']['nombre']]['Prestamo_iva']
						- $t[$credito['Cliente']['Empresa']['nombre']]['Iva'];
					
				}
			}
			$this->Session->write('Creditos',$Creditos);
			$this->Session->write('t',$t);
			$this->Session->write('generales', 'Reporte de Creditos de '  . $fecha_inicio . ' a ' . $fecha_final . ' ');
			$this->set(compact('Creditos'));
			$this->set(compact('t'));
			$this->set('generales');
			$this->set('title_for_layout','');
			$this->set('title', 'Reporte de Creditos de '  . $fecha_inicio . ' a ' . $fecha_final . ' ');
			 //pr($Creditos);
			// pr($t);
		}	

		function creditos_detalle(){
			$this->layout='template';
			if(!empty($this->data)){
				$fecha_inicio=date('Y-m-d',strtotime($this->data['Credito']['fecha_inicio']));
				$fecha_final=date('Y-m-d',strtotime($this->data['Credito']['fecha_final']));
			}else{
				if(date('d')>15){
					$fecha_final=date('Y-m-t');
					$fecha_inicio=date('Y-m-16');
				}else{
					$fecha_inicio=date('y-m-1');
					$fecha_final=date('y-m-16');
				}
			}

			$this->Credito->Behaviors->attach('Containable');
			$Creditos = $this -> Credito -> find('all',array(
				'conditions'=>array(
					'credito.estado'=>'activo',
					// 'credito.fecha_calculo >='=>$fecha_inicio,
					// 'credito.fecha_calculo <='=>$fecha_final,					'credito.fecha_calculo between (? - interval 1 month) and  (? - interval 0 month)' => array($fecha_inicio, $fecha_final),
				),
				'contain'=>array(
					'Cliente'=>array(
						'Empresa'=>array(
							'fields'=>array( 
								'nombre' ),					
							'order'=>array('Empresa.nombre')
						)
					),
					'Pago'=>array(
						'Asociation'=>array(
							'Abono'
						)
					)
				)
			));		
				
			$total=null;
			foreach ($Creditos as $key => $credito) {
				
				if(!isset($total[$credito['Cliente']['Empresa']['nombre']])){
					
					if(!isset($total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']])){
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['capital']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['interes']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['iva']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['saldoinicial']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['pagos']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['saldo']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_interes']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_iva']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_interes']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_iva']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['empresa']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldototal']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_interes']=0;
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_iva']=0;
					}
					
				}	

				$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo']
				 +$credito['Credito']['prestamo'];	
				 
				 foreach ($credito['Pago'] as $key => $pago){
					foreach($pago['Asociation'] as $key => $Asociation){
						foreach ($Asociation['Abono'] as $key => $Abono){
							
				 			$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['capital']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['capital']
				 			+$pago['pago_capital'];
					 	
						}
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['pagos']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['pagos'] + $Asociation['Abono']['abono'];
					}
					
					if($pago['sitacion']=='Pagado'){
							$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['saldoinicial']=$credito['Credito']['prestamo'] - $pago['pago_capital'];
							$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_interes']=$credito['Credito']['prestamo'] - $pago['intereses'];
							$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_iva']=$credito['Credito']['prestamo']- $pago['iva_intereses'];
						}
					
					if($pago['sitacion']=='No pagado'){
						$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldototal']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldototal'] 
						+ $pago['pago_capital'];
					}
					
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['saldo']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['saldoinicial']
				 	+$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo']-$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['pagos'];

					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['interes']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['interes']
					+$pago['intereses'];
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['iva']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['iva']+$pago['iva_intereses'];
					
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_interes']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo']
					- $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['interes'];
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_iva']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo'] 
					- $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['iva'];
					 
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_interes']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_interes'] 
					+ $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_interes'] - $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['interes'];
					$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_iva']=$total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Saldo_inicial_iva']
					+ $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['Prestamo_iva'] - $total[$credito['Cliente']['Empresa']['nombre']][$credito['Cliente']['full_name']]['iva'];
			    }
			}
			$this->Session->write('Creditos',$Creditos);
			$this->Session->write('total',$total);
			$this->Session->write('generales', 'Reporte de Creditos detallado de '  . $fecha_inicio . ' a ' . $fecha_final . ' ');
			$this->set(compact('Creditos'));
			$this->set('total',$total);
			$this->set('title_for_layout','');
			$this->set('title', 'Reporte de Creditos detallado de '  . $fecha_inicio . ' a ' . $fecha_final . ' ');
			// pr($Creditos);
			// pr($total);
		}
	
}
?>