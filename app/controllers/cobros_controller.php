<?php

class CobrosController extends AppController{
	var $name = 'Cobros';
	var $helpers = array('Html', 'Form');
	
	function view($id = null){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$cobro = $this->Cobro->find('first', array(
				'conditions' => array('Cobro.id' => $id),
				
			));
			
			$this->loadModel('Cliente');
			$this->loadModel('Pago');
			
			foreach($cobro['Abono'] as $key => $cliente){
				$cobro['Abono'][$key]['Cliente'] = $this->Cliente->find('first', array(
					'conditions' => array(
						'Cliente.id' => $cliente['cliente_id']
					),
					'fields' => array('full_name'),
					'recursive' => 0
				));
				
				$cobro['Abono'][$key]['Pago'] = $this->Pago->find('all', array(
					'conditions' => array(
						'Pago.abono_id' => $cliente['id']
					),
					'recursive' => 0
				));
			}
			$this->set('title_for_layout', '');
			$this->set(compact('cobro'));
		}
	}
	
	function index(){
		if($this->Session->check('User')){
			$this->layout = 'template';
			$cobros = $this->Cobro->find('all', array(
				'order' => array('Cobro.created' => 'DESC')
			));
			foreach($cobros as $key => $cobro){
				$cobros[$key]['Cobro']['deposito'] = 0;
				foreach($cobro['Abono'] as $abono){
					$cobros[$key]['Cobro']['deposito'] = $cobros[$key]['Cobro']['deposito'] + $abono['abono'];
				}
			}
			$this->set('title_for_layout', '');
			$this->set(compact('cobros'));
		}
	}
	
}

?>