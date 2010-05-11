<?php
class StatusTypesController extends AppController {

	var $name = 'StatusTypes';
	var $helpers = array('Html', 'Form', 'Tracking', 'Paginator');
	var $paginate = array(
		'EquipmentRecord' => array(
			'limit' => 20,
			'order' => array('EquipmentRecord.id'=>'asc')
			)
	);

	function index() {
		$this->StatusType->recursive = 0;
		$this->set('statusTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid StatusType.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->StatusType->recursive = 1;
		$this->set('statusType', $this->StatusType->read(null, $id));
		
		// get pages of equipmentRecords
		$this->paginate = array(
			'contain' => array(
				'Fund',
				'Member',
				'EquipmentType',
				'StatusType'
			)
		);
		$this->set('equipmentRecords', $this->paginate('EquipmentRecord', array('EquipmentRecord.status_type_id'=>$id))); 
	}

	function add() {
		if (!empty($this->data)) {
			$this->StatusType->create();
			if ($this->StatusType->save($this->data)) {
				$this->Session->setFlash(__('The StatusType has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The StatusType could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid StatusType', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->StatusType->save($this->data)) {
				$this->Session->setFlash(__('The StatusType has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The StatusType could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->StatusType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for StatusType', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StatusType->del($id)) {
			$this->Session->setFlash(__('StatusType deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>