<?php

class IngresosController extends AppController{
	var $name='Ingresos';
	var $helpers=array('Html','Form');
	
	function add(){
		if($this->Session->check('User')){
			if($this->Session->check('Cliente')){
			$usuario=$this->Session->read('User');
			$cliente=$this->Session->read('Cliente');
				if($cliente['Cliente']['user_id']==$usuario['User']['id']){
					if(!empty($this->data)){
						$this->data['Ingreso']['cliente_id']=$cliente['Cliente']['id'];
						$ingreso1=$this->data['Ingreso']['salario_imss'];
						$ingreso2=$this->data['Ingreso']['salario_real'];
						$ingreso3=$this->data['Ingreso']['otros_ingresos'];
						$egreso1=$this->data['Ingreso']['egresos_imss'];
						$egreso2=$this->data['Ingreso']['egresos_real'];
						$egreso3=$this->data['Ingreso']['otros_egresos'];
						$this->data['Ingreso']['total_ingresos']=$ingreso1+$ingreso2+$ingreso3;
						$this->data['Ingreso']['total_egresos']=$egreso1+$egreso2+$egreso3;
						if($this->Ingreso->save($this->data)){
							$this->Session->setFlash('Su información se ha guardado con éxito');
							$this->Session->delete('Cliente');
							$this->redirect(array('action'=>'view',$this->data['Ingreso']['cliente_id']));
						}
					}
					
				}
				
			}
		}	
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$cuenta=$this->Ingreso->find('count',array('conditions'=>array('Ingreso.cliente_id'=>$id)));
				if($cuenta>0){
					$ingreso=$this->Ingreso->find('first',array('conditions'=>array('Ingreso.cliente_id'=>$id)));
					$this->set('ingreso',$ingreso);
				}else{
					$this->Session->setFlash('Este usuario aún no cuenta con la información de Ingresos/Egresos');
					$this->redirect(array('controller'=>'clientes','action'=>'sesion',$id,2));
				}
				}
		}

	function edit($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$ingreso=$this->Ingreso->find('first',array('conditons'=>array('Ingreso.id'=>$id)));
			if($ingreso['Cliente']['user_id']==$usuario['User']['id']){
				$this->Ingreso->id=$id;
				if(empty($this->data)){
					$this->data=$this->Ingreso->read();
				}else{
						$ingreso1=$this->data['Ingreso']['salario_imss'];
						$ingreso2=$this->data['Ingreso']['salario_real'];
						$ingreso3=$this->data['Ingreso']['otros_ingresos'];
						$egreso1=$this->data['Ingreso']['egresos_imss'];
						$egreso2=$this->data['Ingreso']['egresos_real'];
						$egreso3=$this->data['Ingreso']['otros_egresos'];
						$this->data['Ingreso']['total_ingresos']=$ingreso1+$ingreso2+$ingreso3;
						$this->data['Ingreso']['total_egresos']=$egreso1+$egreso2+$egreso3;
					if($this->Ingreso->save($this->data)){
						$this->Session->setFlash('Su información se ha guardado con éxito');
						$this->redirect(array('action'=>'view',$this->data['Ingreso']['cliente_id']));
					}
				}
			}
		}
	}
}
?>
