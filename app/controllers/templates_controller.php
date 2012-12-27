<?php

class TemplatesController extends AppController{
	var $name = 'Templates';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->layout = 'template';
	}
	
	function index(){
		$this->loadModel('Cliente');
		$clientes=$this->Cliente->find('all', array(
			'order' => array(
				'Cliente.empresa_id' => 'ASC',
				'Cliente.division' => 'ASC'
				),
			'contain' => array('Empresa')
		));
		$this->set('clientes',$clientes);
	}

	function view($id = null){
		$this->loadModel('Cliente');
		$cliente = $this->Cliente->find('first', array(
			'conditions' => array(
				'Cliente.id' => $id
			),
			'contain' => array('Aval', 'Personal', 'Familiar', 'Ingreso')
		));
		$this->set('title_for_layout', '');
		$this->set(compact('cliente'));
	}

	function credit_history($id = null){
		$this->loadModel('Credito');
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

	function view_credit($id = null){
		$this->loadModel('Credito');
		$this->Credito->Behaviors->attach('Containable');

		$credito = $this->Credito->find('first', array(
			'conditions' => array(
				'Credito.id' => $id
			),
			'contain' => array('Pago', 'Cliente')
		));

		$this->set(compact('credito'));

	}

	function active_credit($id = null){
		$this->loadModel('Credito');
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
			$this->redirect(array('action' => 'add_credit'));
		}
	}

	function add_client(){
		$this->layout = 'wizard';
		$this->loadModel('Empresa');
		$this->loadModel('Cliente');
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
	}

	function add_credit(){

	}

	function login(){
		$this->layout = 'login';

		if(!empty($this->data)){
			if($this->data['User']['name'] === 'victor'){
				if($this->data['User']['password'] === 'vicocamacho'){
					$this->redirect(array('action' => 'index'));
				}
			}

			$this->Session->setFlash(
				'Nombre de usuario y contraseña incorrectos', 
				'login_error'
			);
		}
	}
	
}