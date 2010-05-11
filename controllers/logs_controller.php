<?php
class LogsController extends AppController {

	var $name = 'Logs';
	var $helpers = array('Html', 'Form', 'tracking');

	function index() {
		$this->Log->recursive = -1;
		$this->paginate = array(
			'contain' => array(
				'User',
				'EquipmentRecord' => array(
					'id',
					'Fund',
					'tracking_number'
					
				),
				'Member'
			)
		);
		$this->set('logs', $this->paginate());
	}

	function view($id = null) {
		$this->Log->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Log.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('log', $this->Log->read(null, $id));
	}

	function add() {
		$this->Session->setFlash(__('New logs cannot be created manually', true));
		$this->redirect(array('action'=>'index'));
	
		/*
		if (!empty($this->data)) {
			$this->Log->create();
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The Log has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Log could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Log->User->find('list');
		$equipmentRecords = $this->Log->EquipmentRecord->find('list');
		$members = $this->Log->Member->find('list');
		$this->set(compact('users', 'equipmentRecords', 'members'));
		*/
	}

	function edit($id = null) {
		$this->Session->setFlash(__('Editing logs not allowed', true));
		$this->redirect(array('action'=>'index'));
		
		/*
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Log', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The Log has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Log could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Log->read(null, $id);
		}
		$users = $this->Log->User->find('list');
		$equipmentRecords = $this->Log->EquipmentRecord->find('list');
		$members = $this->Log->Member->find('list');
		$this->set(compact('users','equipmentRecords','members'));
		*/
	}

	function delete($id = null) {
		$this->Session->setFlash(__('Deleting logs not allowed', true));
		$this->redirect(array('action'=>'index'));
		
		/*
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Log', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Log->del($id)) {
			$this->Session->setFlash(__('Log deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		*/
	}

}
?>