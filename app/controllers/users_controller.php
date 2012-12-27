<?php

class UsersController extends AppController{
	var	$name='Users';
	var $helpers=array('Html','Form');
	
	function index(){
		$this->layout = 'login';
	}
	
	function login(){
		if(!empty($this->data)){
			$usuario=$this->data['User']['name'];
			$password=$this->data['User']['password'];
				if(!empty($password)){
	   				$busqueda=$this->User->find('first',array('conditions'=>array('User.name'=>$usuario)));
				if ($busqueda['User']['password']==$password){
				$this->Session->destroy();
				$this->Session->write('User',$busqueda);
				$this->Session->setFlash('Bienvenido');
				$this->redirect(array('action'=>'sesion', 1));
			}
			else{
				$this->Session->setFlash('Nombre de usuario y contraseña incorrectos.', 'login_error');
				$this->redirect(array('action'=>'index'));
			}}else{
			$this->Session->setFlash('Nombre de usuario y contraseña incorrectos.', 'login_error');
			$this->redirect(array('action'=>'index'));
		}
		}
	}
	
	function view_user(){
		if($this->Session->check('User')){
			$user=$this->Session->read('User');
			$usuario=$user['User']['id'];
			$busqueda=$this->User->find('first',array('conditions'=>array('User.id'=>$usuario)));
			$this->set('user',$busqueda);
			$this->Session->write('User',$busqueda);
		}
		else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('action'=>'index'));		
		}
		
	}
	
	function logout(){
		$this->Session->destroy();
		$this->Session->setFlash('Sesión Finalizada.', 'login_error');
		$this->redirect(array('action'=>'index'));
	}
	
	function registro(){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			if($usuario['User']['permisos']=='admin'){
				if(!empty($this->data)){
					if($this->data['User']['password']==$this->data['User']['psword']){
						if($this->User->save($this->data)){
						$this->Session->setFlash('Se ha registrado con éxito.');
						$this->redirect(array('action'=>'view_user'));
						}
					} else {
					$this->Session->setFlash('Los campos de contraseña no con coinciden');
					$this->redirect(array('action'=>'registro'));		
					}
				}
			}else{
			$this->redirect(array('controller'=>'users','action'=>'view_user'));
			}
		}
	}
	
	function editar() {
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$this->User->id=$usuario['User']['id'];
			if(empty($this->data)){
				$this->data=$this->User->read();
			}else{
				if($this->User->save($this->data)){
					$busqueda=$this->User->find('first',array('conditions'=>array('User.id'=>$usuario['User']['id'])));
					$this->Session->write('User',$busqueda);
					$this->Session->setFlash('Su información se ha actualizado');
					$this->redirect(array('action'=>'view_user'));
				}
			}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión.');
			$this->redirect(array('action'=>'index'));		
		}
	}
	
	function cambiar_password(){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$this->User->id=$usuario['User']['id'];
			$busqueda=$this->User->read();
			if(!empty($this->data)){
				if($this->data['User']['psword']==$busqueda['User']['password']){					
					if($this->data['User']['password']==$this->data['User']['passwd']){
						if($this->User->save($this->data)){
							$this->Session->setFlash('Su información se ha actualizado');
							$this->redirect(array('action'=>'view_user'));
						}
					}else{
						$this->data=null;
						$this->Session->setFlash('Los campos de contraseña nueva deben ser idénticos');
					}
				}else{
					$this->data=null;
					$this->Session->setFlash('Su contraseña actual no coincide');
				}
			}
		}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('action'=>'index'));			
		}
	}

	
	function empresa_view(){
		if($this->Session->check('User')){
				$this->layout = 'template';
				$usuario=$this->Session->read('User');
				$empresas = $this->User->Empresa->find('all', array('contain' => false));
				$this->set('empresas',$empresas);
				$this->set('title_for_layout', 'Empresas');	
			}else{
			$this->Session->setFlash('Necesita iniciar sesión');
			$this->redirect(array('controller'=>'users'));
		}
	}
	
	function sesion($id=null){
		if($this->Session->check('User')){
			$usuario=$this->Session->read('User');
			$busqueda=$this->User->find('first',array('conditions'=>array('User.id'=>$usuario['User']['id'])));
			$this->Session->write('User',$busqueda);
			if($id==1){
				$this->redirect(array('controller'=>'clientes','action'=>'view2',$usuario['User']['id']));
			}
			if($id==2){
				$this->redirect(array('action'=>'empresa_view',$usuario['User']['id']));
			}
		}
	}
	
}
