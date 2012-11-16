<?php

class ClientesController extends AppController{
	var $name='Clientes';
	var $helpers=array('Html','Form');
	
	
	
	function modulopago($id){
		if($this->Session->check('User')){
		$pagos=$this->Cliente->Credito->find('first',array('conditions'=>array('Cliente.id'=>$id)));
		$this->Session->write('credito',$pagos);
		$this->set('cliente',$pagos['Cliente']['nombre'].' '.$pagos['Cliente']['apellido_paterno'].' '.$pagos['Cliente']['apellido_materno']);
		$this->set('pagos',$pagos);
		}
	}
// 	
	// function estadodecuenta($id=null){
			// if($this->Session->check('User')){
				// $busqueda=$this->Cliente->Credito->find('all',array('conditions'=>array('Cliente.empresa_id'=>$id)));
				// $empresa=$this->Cliente->find('first',array('conditions'=>array('Cliente.empresa_id'=>$id)));
				// $this->Session->write('busqueda',$busqueda);
				// $this->Session->write('nombre',$empresa['Empresa']['nombre']);
				// $this->redirect(array('controller'=>'incidencias','action'=>'estadodecuenta'));
			// }
		// }
	
	function add(){
		if($this->Session->check('User')){
			$empresa=$this->Session->read('empresa');	
			if(!empty($this->data)){
				$usuario=$this->Session->read('User');
				$this->data['Cliente']['user_id']=$usuario['User']['id'];
				$this->data['Cliente']['empresa_id']=$empresa['Empresa']['id'];
					if($this->Cliente->save($this->data)){
						$this->Session->setFlash('Su cliente se ha añadido con éxito.');
						$this->Session->write('Cliente',$this->Cliente->read());
						$this->redirect(array('controller'=>'users','action'=>'view_user'));
					}	
			}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('controller'=>'users','action'=>'index'));
		}
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$cliente=$this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$id), 'contain' => array('Empresa')));
				$this->set('cliente',$cliente);
		}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function edit($id=null){
		if($this->Session->check('User')){
		 $usuario=$this->Session->read('User');
		 $cliente=$this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$id)));
			 $this->Cliente->id=$id;
				if(empty($this->data)){
				 $this->data=$this->Cliente->read();
				}else{
					if($this->Cliente->save($this->data)){
					 $this->Session->setFlash('La información de su cliente se ha actualizado con éxito');
					 $this->redirect(array('controller'=>'clientes','action'=>'view',$this->data['Cliente']['id']));
					}
				} 		
		}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function sesion($id=null,$id2=null){
		if($this->Session->check('User')){
				$usuario=$this->Session->read('User');
				$cliente=$this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$id)));
				if($this->Session->write('Cliente',$cliente)){
					if($id2==1){
					$this->redirect(array('controller'=>'avals','action'=>'add2'));
					}
					if($id2==2){
					$this->redirect(array('controller'=>'ingresos','action'=>'add'));	
					}
					if($id2==3){
					$this->redirect(array('controller'=>'personals','action'=>'add'));	
					}
					if($id2==4){
					$this->redirect(array('controller'=>'familiars','action'=>'add'));	
					}
					if($id2==5){
					$this->redirect(array('controller'=>'creditos','action'=>'add'));	
					}
				}
		}
	}
	
	function view2($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
				$clientes=$this->Cliente->find('all', array(
					'order' => array(
						'Cliente.empresa_id' => 'ASC',
						'Cliente.division' => 'ASC'
						),
					'contain' => array('Empresa')
				));
				$this->set('clientes',$clientes);
		}
	}
	
	function add2(){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('empresa');
			$this->set('empresas',$usuario);
		}
		
	}
	
	function incidencia($id=null){
		if($this->Session->check('User')){
			
			if(!empty($this->data)){
				$fecha_inicio= date('Y-m-d', strtotime($this->data['Cliente']['fecha_inicio']));
				$fecha_final= date('Y-m-d', strtotime($this->data['Cliente']['fecha_final']));
				$periodo=$this->data['Cliente']['periodo'];
				$id=$this->data['Cliente']['id'];
			}else{
				
				if(date('d')>15){
					$fecha_final = date('Y-m-t');
					$fecha_inicio = date('Y-m-16');
				}else{
					$fecha_inicio = date('Y-m-1');
					$fecha_final = date('Y-m-15');
				}
				
				$periodo = 'quincenal';
			}
			
			$clientes = $this->Cliente->Credito->find('all', array(
				'conditions' => array(
					'Cliente.empresa_id' => $id,
					'Credito.periodo_cuotas' => $periodo,
					'Credito.estado' => 'activo'
				),
				'recursive' => 0
			)); 
			
			$empresa = $this->Cliente->Empresa->find('first', array(
				'conditions' => array(
					'Empresa.id' => $id
				),
				'recursive'=> 0
			));
			
			$total['nombre_empresa'] = $empresa['Empresa']['nombre'];
			$total['Capital']=0;
			$total['Pago']=0;
			$total['Interes']=0;
			$total['Iva']=0;													
			$i=0;
			foreach($clientes as $key => $cliente){
				$pagos[$key] = $this->Cliente->Credito->Pago->find('all', array(
					'conditions' => array(
						'Pago.credito_id' => $cliente['Credito']['id'],
						'Pago.fecha_bien >=' => $fecha_inicio,
						'Pago.fecha_bien <=' => $fecha_final,
						'Pago.sitacion' => 'No pagado'
					)
				));
				
			}
					
			foreach($pagos as $key => $arreglo){
				foreach($arreglo as $pago){
					$total['Capital'] = $total['Capital'] + round($pago['Pago']['pago_capital'], 2);
					$total['Pago'] = $total['Pago'] + round($pago['Pago']['pago'], 2);
					$total['Interes'] = $total['Interes'] + round($pago['Pago']['intereses'], 2);
					$total['Iva'] = $total['Iva'] + round($pago['Pago']['iva_intereses'], 2);															
				}
			}
			// $clientes=$this->Cliente->Credito->find('all', array('conditions' => array(
																						// 'Cliente.empresa_id' => $id,
																						// 'Credito.periodo_cuotas' => $periodo,
																						// 'Credito.estado' => 'activo'
																						// )
																// ));
			// $empresa=$this->Cliente->find('first',array('conditions' => array(
							// 'Cliente.empresa_id' => $id
							// )
						// ));	
// 								
			// $total['nombre_empresa']=$empresa['Empresa']['nombre'];
			// $total['Capital']=0;
			// $total['Pago']=0;
			// $total['Interes']=0;
			// $total['Iva']=0;													
			// $i=0;
// 
			// foreach($clientes as $creditos){
				// foreach($creditos['Pago'] as $pago){
					// $fecha =  new DateTime($pago['fecha']);
					// $comparacion1 =  $fecha_inicio->diff($fecha);
					// $comparacion2 = $fecha->diff($fecha_final);
					// if($comparacion1->format('%R%a')>=0 and $comparacion2->format('%R%a')>=0){
// 							
						// $abono = $this->Cliente->Credito->Pago->Abono->find('first',array(
							// 'conditions'=>array('Pago.id' => $pago['id']),
							// 'order'=>array('Abono.id DESC')
						// ));
						// $pagos_pagados = $this->Cliente->Credito->Pago->find('count', array(
							// 'conditions' => array(
								// 'Pago.credito_id' => $creditos['Credito']['id'],
								// 'Pago.sitacion' => 'Pagado'
							// )
						// ));
// 						
						// $arreglo[$i]=$pago;
						// $redondeo = round($pago['pago'], 2);
						// $arreglo[$i]['prestamo'] = $redondeo*$creditos['Credito']['cuotas'] - $redondeo*$pagos_pagados;
// 						
						// if($abono){
							// $arreglo[$i]['saldo']=$abono['Abono']['saldo'];
							
							// if($pago['sitacion'] != 'Pagado'){
								// $arreglo[$i]['prestamo'] = $arreglo[$i]['prestamo'] - ($redondeo - $abono['Abono']['saldo']);
							// }
						// }
// 						
// 						
						// $arreglo[$i]['cheque']=$creditos['Credito']['cheque'];
						// $arreglo[$i]['nombre']=$creditos['Cliente']['nombre'] . ' ' . $creditos['Cliente']['apellido_paterno'] . ' ' . $creditos['Cliente']['apellido_materno'];
						// isset($creditos['Cliente']['division']) ? $arreglo[$i]['division']=$creditos['Cliente']['division'] : '' ;
						// $i++;
						// $total['Capital']=$total['Capital']+$pago['pago_capital'];
						// $total['Pago']=$total['Pago']+$pago['pago'];
						// $total['Interes']=$total['Interes']+$pago['intereses'];
						// $total['Iva']=$total['Iva']+$pago['iva_intereses'];
					// }
// 					
				// }
// 				
			//}
			// $this->Session->write('incidencia', $arreglo);
			// $this->Session->write('generales', $total);
			$this->Session->write('clientes', $clientes);
			$this->Session->write('incidencia', $pagos);
			$this->Session->write('generales', $total);
			$this->set('empresa', $empresa);			$this->set('clientes', $clientes);
			$this->set('id', $id);
			$this->set('pagos', $pagos);
			$this->set('total', $total);
			
		}
	}
	
	// function incidencia($id=null,$id2=null){
			// if($this->Session->check('User')){
					// $usuario=$this->Session->read('User');
					// $meses=array(0,'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
					// if($id){
							// $this->Session->write('id',$id);
					// }else{
						// $id=$this->Session->read('id');
					// }
// 				
					// if(!empty($this->data)){
						// $periodo=$this->data['Cliente']['periodo'];
						// switch($this->data['Cliente']['periodo']){
							// case 'semanal':
								// $fecha_aux=mktime(0,0,0,$this->data['Cliente']['fecha']['month'],$this->data['Cliente']['fecha']['day'],$this->data['Cliente']['fecha']['year']);
								// $fecha_busqueda=date('W',$fecha_aux);
								// $fecha_viernes=date('N',$fecha_aux);
								// switch($fecha_viernes){
									// case 1:
									// $prelim_fecha=date('c',strtotime('+4 days',$fecha_aux));
									// break;
									// case 2:
									// $prelim_fecha=date('c',strtotime('+3 days',$fecha_aux));
									// break;
									// case 3:
									// $prelim_fecha=date('c',strtotime('+2 days',$fecha_aux));
									// break;
									// case 4:
									// $prelim_fecha=date('c',strtotime('+1 days',$fecha_aux));
									// break;
									// case 5:
									// $prelim_fecha=date('c',$fecha_aux);
									// break;
									// case 6:
									// $prelim_fecha=date('c',strtotime('-1 days',$fecha_aux));
									// break;
									// case 7:
									// $prelim_fecha=date('c',strtotime('+2 days',$fecha_aux));
									// break;
								// }
								// $prelim2=explode('T',$prelim_fecha);
								// $prelim3=explode('-',$prelim2[0]);
								// $viernes=$prelim3[2].' de '.$meses[$prelim3[1][0]*10+$prelim3[1][1]].' de '.$prelim3[0];
								// $fecha_anio=$this->data['Cliente']['fecha']['year'];
							// break;
							// case 'quincenal':
								// $anio=$this->data['Cliente']['fecha']['year'];
								// $mes=$this->data['Cliente']['fecha']['month'];
								// if($this->data['Cliente']['fecha']['day']<=15){
									// $dia=15;
								// }else{
									// $dia=date('t',mktime(0,0,0,$this->data['Cliente']['fecha']['month'],$this->data['Cliente']['fecha']['day'],$this->data['Cliente']['fecha']['year']));
								// }
								// $viernes=$dia.' de '.$meses[$mes[0]*10+$mes[1]].' de '.$anio;
							// break;
							// case 'mensual':
								// $anio=$this->data['Cliente']['fecha']['year'];
								// $mes=$this->data['Cliente']['fecha']['month'];
								// $viernes='Mensual';
							// break;
						// }
// 						
					// }else{
						// $fecha_busqueda=date('W');
						// $fecha_anio=date('Y');
						// $periodo='semanal';
						// switch(date('N')):
							// case 1:
								// $prelim=date('c',strtotime('+4 days'));
							// break;
							// case 2:
								// $prelim=date('c',strtotime('+3 days'));
							// break;
							// case 3:
								// $prelim=date('c',strtotime('+2 days'));
							// break;
							// case 4:
								// $prelim=date('c',strtotime('+1 days'));
							// break;
							// case 5:
								// $prelim=date('c');
							// break;
							// case 6:
								// $prelim=date('c',strtotime('-1 days'));
							// break;
							// case 7:
								// $prelim=date('c',strtotime('-2 days'));
							// break;
						// endswitch;
								// $prelim2=explode('T',$prelim);
								// $prelim3=explode('-',$prelim2[0]);
								// $viernes=$prelim3[2].' de '.$meses[$prelim3[1][0]*10+$prelim3[1][1]].' de '.$prelim3[0];
					// }
					// $busqueda=$this->Cliente->Credito->find('all',array('conditions'=>array('Cliente.empresa_id'=>$id,'Credito.periodo_cuotas'=>$periodo,'Credito.estado'=>'activo')));
					// $empresa=$this->Cliente->find('first',array('conditions'=>array('Cliente.empresa_id'=>$id)));
					// $cuenta=0;
					// $total['Capital']=0;
					// $total['Interes']=0;
					// $total['Iva']=0;
					// $total['Pago']=0;
					// foreach($busqueda as $cliente){
						// foreach($cliente['Pago'] as $pagos){
							// $explode=explode('-',$pagos['fecha']);
// 							
								// switch($periodo){
									// case 'semanal':
										// $fecha=date('W',mktime(0,0,0,$explode[1],$explode[0],$explode[2]));
										// if($fecha==$fecha_busqueda and $explode[2]==$fecha_anio){
										 // $arreglo[$cuenta]['nombre']=$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'];
										 // $arreglo[$cuenta]['cheque']=$cliente['Credito']['cheque'];
										 // $arreglo[$cuenta]['fecha']=$pagos['fecha'];
										 // $arreglo[$cuenta]['pago']=$pagos['pago'];
										 // $arreglo[$cuenta]['pago_capital']=$pagos['pago_capital'];
										 // $arreglo[$cuenta]['intereses']=$pagos['intereses'];
										 // $arreglo[$cuenta]['iva']=$pagos['iva_intereses'];
										 // $arreglo[$cuenta]['sitacion']=$pagos['sitacion'];
										 // $arreglo[$cuenta]['id']=$pagos['id'];
										 // $arreglo[$cuenta]['saldo_insoluto']=$pagos['saldo_insoluto'];
										 // $arreglo[$cuenta]['credito_id']=$pagos['credito_id'];
										 // $arreglo[$cuenta]['numero_pago']=$pagos['numero_pago'];
										 // $total['Pago']=$total['Pago']+$pagos['pago'];
										 // $total['Capital']=$total['Capital']+$pagos['pago_capital'];
										 // $total['Interes']=$total['Interes']+$pagos['intereses'];
										 // $total['Iva']=$total['Iva']+$pagos['iva_intereses'];
										 // $cuenta++;
										// }
									// break;
									// case 'quincenal':
										// if($dia==$explode[0] and $explode[2]==$anio and $explode[1]==$mes){
										 // $arreglo[$cuenta]['nombre']=$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'];
										 // $arreglo[$cuenta]['cheque']=$cliente['Credito']['cheque'];
										 // $arreglo[$cuenta]['fecha']=$pagos['fecha'];
										 // $arreglo[$cuenta]['pago']=$pagos['pago'];
										 // $arreglo[$cuenta]['pago_capital']=$pagos['pago_capital'];
										 // $arreglo[$cuenta]['intereses']=$pagos['intereses'];
										 // $arreglo[$cuenta]['iva']=$pagos['iva_intereses'];
										 // $arreglo[$cuenta]['sitacion']=$pagos['sitacion'];
										 // $arreglo[$cuenta]['id']=$pagos['id'];
										 // $arreglo[$cuenta]['saldo_insoluto']=$pagos['saldo_insoluto'];
										 // $arreglo[$cuenta]['credito_id']=$pagos['credito_id'];
										 // $arreglo[$cuenta]['numero_pago']=$pagos['numero_pago'];
										 // $total['Pago']=$total['Pago']+$pagos['pago'];
										 // $total['Capital']=$total['Capital']+$pagos['pago_capital'];
										 // $total['Interes']=$total['Interes']+$pagos['intereses'];
										 // $total['Iva']=$total['Iva']+$pagos['iva_intereses'];
										 // $cuenta++;
										// }
// 										
									// break;
									// case 'mensual':
										// if($explode[2]==$anio and $explode[1]==$mes){
										 // $arreglo[$cuenta]['nombre']=$cliente['Cliente']['nombre'].' '.$cliente['Cliente']['apellido_paterno'].' '.$cliente['Cliente']['apellido_materno'];
										 // $arreglo[$cuenta]['cheque']=$cliente['Credito']['cheque'];
										 // $arreglo[$cuenta]['fecha']=$pagos['fecha'];
										 // $arreglo[$cuenta]['pago']=$pagos['pago'];
										 // $arreglo[$cuenta]['pago_capital']=$pagos['pago_capital'];
										 // $arreglo[$cuenta]['intereses']=$pagos['intereses'];
										 // $arreglo[$cuenta]['iva']=$pagos['iva_intereses'];
										 // $arreglo[$cuenta]['sitacion']=$pagos['sitacion'];
										 // $arreglo[$cuenta]['id']=$pagos['id'];
										 // $arreglo[$cuenta]['saldo_insoluto']=$pagos['saldo_insoluto'];
										 // $arreglo[$cuenta]['credito_id']=$pagos['credito_id'];
										 // $arreglo[$cuenta]['numero_pago']=$pagos['numero_pago'];
										 // $total['Pago']=$total['Pago']+$pagos['pago'];
										 // $total['Capital']=$total['Capital']+$pagos['pago_capital'];
										 // $total['Interes']=$total['Interes']+$pagos['intereses'];
										 // $total['Iva']=$total['Iva']+$pagos['iva_intereses'];
										 // $cuenta++;
										// }
// 										
									// break;
								// }
						// }
					// }
// 
					// $this->set('user',$usuario);
					// if(isset($arreglo) or $id2==1){
					// $total['nombre_empresa']=$empresa['Empresa']['nombre'];
					// $total['viernes']=$viernes;
					// $total['periodo']=$periodo;
					// $this->set('total',$total);
					// $this->set('pagos',$arreglo);
					// $this->Session->write('generales',$total);
					// $this->Session->write('incidencia',$arreglo);
					// }else{
						// $this->Session->setFlash('No se encontraron pagos para la fecha solicitada');
						// $this->redirect(array('controller'=>'clientes','action'=>'incidencia',$id,1));
					// }
				// }
		// }

	function delete($id=null){
		if($this->Session->check('User')){
			$this->Cliente->delete($id,true);
			$this->redirect(array('action'=>'view2'));
		}
	}
	
}

?>
