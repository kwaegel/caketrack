<?php
class EquipmentTypesController extends AppController {

	var $name = 'EquipmentTypes';
	var $helpers = array('Html', 'Form', 'Tracking', 'Paginator');
	var $paginate = array(
		'EquipmentRecord' => array(
			'limit' => 20,
			'order' => array('EquipmentRecord.id'=>'asc')
			)
	);
	
	function index() {
		$this->EquipmentType->recursive = 0;
		$this->set('equipmentTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EquipmentType.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('equipmentType', $this->EquipmentType->read(null, $id));
		
		// get pages of equipmentRecords
		$this->paginate = array(
			'contain' => array(
				'Fund',
				'Member',
				'EquipmentType',
				'StatusType'
			)
		);
		$this->set('equipmentRecords', $this->paginate('EquipmentRecord', array('EquipmentRecord.equipment_type_id'=>$id))); 
	}

	function add() {
		if (!empty($this->data)) {
			$this->EquipmentType->create();
			if ($this->EquipmentType->save($this->data)) {
				$this->Session->setFlash(__('The EquipmentType has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The EquipmentType could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EquipmentType', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->EquipmentType->save($this->data)) {
				$this->Session->setFlash(__('The EquipmentType has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The EquipmentType could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EquipmentType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EquipmentType', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EquipmentType->del($id)) {
			$this->Session->setFlash(__('EquipmentType deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>