<?php

class AvalsController extends AppController{
	
	var $name='Avals';
	var $helper=array('Html','Form');
	
	function add(){
		if($this->Session->check('User')){
			if(!empty($this->data)){
				$empresa=$this->Session->read('empresa');
				$cliente=$this->Session->read('Cliente');
				$this->data['Aval']['cliente_id']=$cliente['Cliente']['id'];
				$usuario=$this->Session->read('User');
				$this->data['Aval']['user_id']=$usuario['User']['id'];
				if($this->Aval->save($this->data)){
					$this->Session->setFlash('Su información se ha guardado con éxito');
					$this->Session->delete('Cliente');
					$this->redirect(array('controller'=>'empresas','action'=>'view',$this->data['Aval']['cliente_id']));
				}
			}
			
		}else{
			$this->Session->setFlash('Necesita iniciar sesión primero');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function view($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$aval=$this->Aval->find('first',array('conditions'=>array('Aval.cliente_id'=>$id)));
			if($aval){
				$this->set('aval',$aval);
			}else{$this->Session->setFlash('Este Cliente aún no cuenta con un aval');
				$this->redirect(array('controller'=>'clientes','action'=>'sesion',$id,1));}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión primero');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function add2(){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$cliente=$this->Session->read('Cliente');
			$busqueda=$this->Aval->find('count',array('conditions'=>array('Aval.cliente_id'=>$cliente['Cliente']['id'])));
				 if($busqueda==0){
					if(!empty($this->data)){
					$this->data['Aval']['cliente_id']=$cliente['Cliente']['id'];
					$this->data['Aval']['user_id']=$usuario['User']['id'];
						if($this->Aval->save($this->data)){
							$this->Session->delete('Cliente');
							$this->Session->setFlash('Su información se ha guardado éxito');
							$this->redirect(array('controller'=>'clientes','action'=>'view',$this->data['Aval']['cliente_id']));
						
						}
					}
			 	}else{
			 	$this->Session->delete('Cliente');
				$this->Session->setFlash('Este usuario ya tiene un aval');
				$this->redirect(array('controller'=>'clientes','action'=>'view',$this->data['Aval']['cliente_id']));
				}
			
		}else{
			$this->Session->setFlash('Necesita iniciar sesión primero');
			$this->redirect(array('controller'=>'users'));
		}
	}

	function edit($id=null){
			if($this->Session->check('User')){
				$usuario=$this->Session->read('User');
				$aval=$this->Aval->find('first',array('conditions'=>array('Aval.id'=>$id)));
					if(empty($this->data)){
						$this->data=$this->Aval->read();
					}else{
						if($this->Aval->save($this->data)){
							$this->Session->setFlash('La información se ha actualizado con éxito');
							$this->redirect(array('controller'=>'clientes','action'=>'view',$this->data['Aval']['cliente_id']));	
						}
					}
			}else{
			$this->Session->setFlash('Necesita iniciar sesión primero');
			$this->redirect(array('controller'=>'users'));
		}
				
	}
	
	
}

?>
