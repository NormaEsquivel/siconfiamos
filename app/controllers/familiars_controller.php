<?php

class FamiliarsController extends AppController{
	var $name='Familiars';
	var $helpers=array('Html','Form');
	
	function add(){
		if($this->Session->check('User')){
			if($this->Session->check('Cliente')){
			$usuario=$this->Session->read('User');
			$cliente=$this->Session->read('Cliente');
					if(!empty($this->data)){
						$this->data['Familiar']['cliente_id']=$cliente['Cliente']['id'];
						if($this->Familiar->save($this->data)){
							$this->Session->setFlash('Su información se ha guardado con éxito');
							$this->Session->delete('Cliente');
							$this->redirect(array('action'=>'view',$this->data['Familiar']['cliente_id']));
						}
					}
					
				}
		}	
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$cuenta=$this->Familiar->find('count',array('conditions'=>array('Familiar.cliente_id'=>$id)));
				if($cuenta>0){
					$familiar=$this->Familiar->find('first',array('conditions'=>array('Familiar.cliente_id'=>$id)));
					$this->set('familiar',$familiar);
				}else{
					$this->Session->setFlash('Este usuario aún no cuenta con Referencias Familiares');
					$this->redirect(array('controller'=>'clientes','action'=>'sesion',$id,4));
				}
				}
		}

	function edit($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$familiar=$this->Familiar->find('first',array('conditons'=>array('Familiar.id'=>$id)));
				$this->Familiar->id=$id;
				if(empty($this->data)){
					$this->data=$this->Familiar->read();
				}else{
					if($this->Familiar->save($this->data)){
						$this->Session->setFlash('Su información se ha guardado con éxito');
						$this->redirect(array('action'=>'view',$this->data['Familiar']['cliente_id']));
					}
				}
		}
	}
}
?>