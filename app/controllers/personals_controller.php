<?php

class PersonalsController extends AppController{
	var $name='Personals';
	var $helpers=array('Html','Form');
	
	function add(){
		if($this->Session->check('User')){
			if($this->Session->check('Cliente')){
			$usuario=$this->Session->read('User');
			$cliente=$this->Session->read('Cliente');
					if(!empty($this->data)){
						$this->data['Personal']['cliente_id']=$cliente['Cliente']['id'];
						if($this->Personal->save($this->data)){
							$this->Session->setFlash('Su información se ha guardado con éxito');
							$this->Session->delete('Cliente');
							$this->redirect(array('action'=>'view',$this->data['Personal']['cliente_id']));
						}
					}
			}
		}	
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$cuenta=$this->Personal->find('count',array('conditions'=>array('Personal.cliente_id'=>$id)));
				if($cuenta>0){
					$personal=$this->Personal->find('first',array('conditions'=>array('Personal.cliente_id'=>$id)));
					$this->set('referencia',$personal);
				}else{
					$this->Session->setFlash('Este usuario aún no cuenta con Referencias Personales');
					$this->redirect(array('controller'=>'clientes','action'=>'sesion',$id,3));
				}
				}
		}

	function edit($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$personal=$this->Personal->find('first',array('conditons'=>array('Personal.id'=>$id)));
				$this->Personal->id=$id;
				if(empty($this->data)){
					$this->data=$this->Personal->read();
				}else{
					if($this->Personal->save($this->data)){
						$this->Session->setFlash('Su información se ha guardado con éxito');
						$this->redirect(array('action'=>'view',$this->data['Personal']['cliente_id']));
					}
				}
		}
	}
}
?>
