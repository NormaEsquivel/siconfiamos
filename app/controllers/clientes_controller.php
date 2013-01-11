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
			$this->layout = 'wizard';
			$this->loadModel('Empresa');
			$empresas = $this->Empresa->find('list', array(
				'fields' => array('Empresa.id', 'Empresa.nombre')
			));
			$this->set(compact('empresas'));

			if(!empty($this->data)){
				$this->data['Cliente']['fecha_nacimiento'] = $this->data['Cliente']['fecha_nacimiento']['year'] . '-' . $this->data['Cliente']['fecha_nacimiento']['month'] . '-' . $this->data['Cliente']['fecha_nacimiento']['day'];
				$this->data['Cliente']['antiguedad_laboral'] = $this->data['Cliente']['antiguedad_laboral']['year'] . '-' . $this->data['Cliente']['antiguedad_laboral']['month'] . '-' . $this->data['Cliente']['antiguedad_laboral']['day'];
				$this->data['Aval']['fecha_nacimiento'] = $this->data['Aval']['fecha_nacimiento']['year'] . '-' . $this->data['Aval']['fecha_nacimiento']['month'] . '-' . $this->data['Aval']['fecha_nacimiento']['day'];
				$this->data['Ingreso']['total_ingresos'] = $this->data['Ingreso']['salario_imss'] + $this->data['Ingreso']['salario_real'] + $this->data['Ingreso']['otros_ingresos'];
				$this->data['Ingreso']['total_egresos'] = $this->data['Ingreso']['egresos_imss'] + $this->data['Ingreso']['egresos_real'] + $this->data['Ingreso']['otros_egresos'];


				if($this->Cliente->saveAll($this->data)){
					$this->redirect(array('action' => 'index'));
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
			$cliente = $this->Cliente->find('first', array(
				'conditions' => array(
					'Cliente.id' => $id
				),
				'contain' => array('Aval', 'Personal', 'Familiar', 'Ingreso')
			));
			$this->set('title_for_layout', '');
			$this->set(compact('cliente'));

		}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function edit($id=null){
		if($this->Session->check('User')){
			$this->layout = 'wizard';
		 $usuario=$this->Session->read('User');
		 $cliente=$this->Cliente->find('first',array(
			'conditions'=>array('Cliente.id'=>$id),
		 	'contain' => array('Aval', 'Personal', 'Familiar', 'Ingreso', 'Empresa')
		));
		 $this->loadModel('Empresa');
		 $empresas = $this->Empresa->find('list', array(
			'fields' => array('Empresa.id', 'Empresa.nombre'),
			'contain' => false
		));
		 $this->set(compact('empresas'));
			 $this->Cliente->id=$id;
				if(empty($this->data)){
				 $this->data =$cliente;
				 // pr($this->data);exit;
				}else{
					$this->data['Cliente']['fecha_nacimiento'] = $this->data['Cliente']['fecha_nacimiento']['year'] . '-' . $this->data['Cliente']['fecha_nacimiento']['month'] . '-' . $this->data['Cliente']['fecha_nacimiento']['day'];
					$this->data['Cliente']['antiguedad_laboral'] = $this->data['Cliente']['antiguedad_laboral']['year'] . '-' . $this->data['Cliente']['antiguedad_laboral']['month'] . '-' . $this->data['Cliente']['antiguedad_laboral']['day'];
					$this->data['Aval']['fecha_nacimiento'] = $this->data['Aval']['fecha_nacimiento']['year'] . '-' . $this->data['Aval']['fecha_nacimiento']['month'] . '-' . $this->data['Aval']['fecha_nacimiento']['day'];
					$this->data['Ingreso']['total_ingresos'] = $this->data['Ingreso']['salario_imss'] + $this->data['Ingreso']['salario_real'] + $this->data['Ingreso']['otros_ingresos'];
					$this->data['Ingreso']['total_egresos'] = $this->data['Ingreso']['egresos_imss'] + $this->data['Ingreso']['egresos_real'] + $this->data['Ingreso']['otros_egresos'];

					if($this->Cliente->saveAll($this->data)){
					 $this->Session->setFlash('La información de su cliente se ha actualizado con éxito');
					 $this->redirect(array('controller'=>'clientes','action'=>'view',$this->data['Cliente']['id']));
					}

					pr($this->Cliente->invalidFields());exit;
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

			$this->layout = 'template';

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
			$this->layout = 'template';
			if(!empty($this->data)){
				$explode_inicio = explode('/', $this->data['Cliente']['fecha_inicio']);
				$explode_final = explode('/', $this->data['Cliente']['fecha_final']);
				$fecha_inicio= $explode_inicio[2] . '-' . $explode_inicio[1] . '-' . $explode_inicio[0];
				$fecha_final= $explode_final[2] . '-' . $explode_final[1] . '-' . $explode_final[0];;
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

			// pr($fecha_inicio);exit;
			
			$this->Cliente->Credito->Behaviors->attach('Containable');

			$clientes = $this->Cliente->Credito->find('all', array(
				'conditions' => array(
					'Credito.periodo_cuotas' => $periodo,
					'Credito.estado' => 'activo',
					'Cliente.empresa_id' => $id
				),
				'contain' => array(
					'Cliente' 
				)
			)); 
			//pr($clientes);exit;
			// pr($this->data);exit;
			
			$empresa = $this->Cliente->Empresa->find('first', array(
				'conditions' => array(
					'Empresa.id' => $id
				),
				'contain' => false
			));
			
			$total['nombre_empresa'] = $empresa['Empresa']['nombre'];
			$total['Capital']=0;
			$total['Pago']=0;
			$total['Interes']=0;
			$total['Iva']=0;													
			$i=0;

			if($clientes != null){

				foreach($clientes as $key => $cliente){
					$pagos[$key] = $this->Cliente->Credito->Pago->find('all', array(
						'conditions' => array(
							'Pago.credito_id' => $cliente['Credito']['id'],
							'Pago.fecha_bien >=' => $fecha_inicio,
							'Pago.fecha_bien <=' => $fecha_final,
							'Pago.sitacion' => 'No pagado'
						),
						'contain' => false
					));
					
				}
			}
			
			if(isset($pagos)){

				foreach($pagos as $key => $arreglo){
					foreach($arreglo as $pago){
						$total['Capital'] = $total['Capital'] + round($pago['Pago']['pago_capital'], 2);
						$total['Pago'] = $total['Pago'] + round($pago['Pago']['pago'], 2);
						$total['Interes'] = $total['Interes'] + round($pago['Pago']['intereses'], 2);
						$total['Iva'] = $total['Iva'] + round($pago['Pago']['iva_intereses'], 2);															
					}
				}
				$this->Session->write('incidencia', $pagos);
				$this->set('pagos', $pagos);
				
			}

			$this->Session->write('total', $total);
			$this->Session->write('clientes', $clientes);
			$this->Session->write('generales', 'Incidencia ' . $periodo . ' de ' . $empresa['Empresa']['nombre'] . ' ( ' . $fecha_inicio . ' a ' . $fecha_final . ')');
			$this->set('empresa', $empresa);
			$this->set('clientes', $clientes);
			$this->set('id', $id);
			$this->set('total', $total);
			$this->set('title_for_layout', '');
			$this->set('title', 'Incidencia ' . $periodo . ' de ' . $empresa['Empresa']['nombre'] . ' ( ' . $fecha_inicio . ' a ' . $fecha_final . ')'); 
		}
	}

	function delete($id=null){
		if($this->Session->check('User')){
			$this->Cliente->delete($id,true);
			$this->redirect(array('action'=>'view2'));
		}
	}

	
}
?>
