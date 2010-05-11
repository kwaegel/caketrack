<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $helpers = array('Html', 'Form', 'Tracking', 'Paginator');
	var $paginate = array(
		'EquipmentRecord' => array(
			'limit' => 3,
			'order' => array('EquipmentRecord.id'=>'asc')
			)
	);

	function index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}

	function view($id = null) {
		$this->Member->recursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Member.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		// set what related member data to retreve
		$this->Member->contain(
			'EquipmentRecord',
			'EquipmentRecord.Fund',
			'EquipmentRecord.EquipmentType',
			'EquipmentRecord.StatusType'
		);
		$this->set('member', $this->Member->read(null, $id));
		
		/*
		// get pages of all the equipmentRecords this member has
		$this->paginate = array(
			'limit' => 10, 
			'contain' => array(
				'Fund',
				'EquipmentType',
				'StatusType',
				'Member'
			)
		);
		$this->set('equipmentRecords', $this->paginate('EquipmentRecord', array('EquipmentRecord.member_id'=>$id)));
		*/
		
		// get pages of all logs related to this member
		$this->paginate = array(
			'fields' => array('Log.created', 'Log.user_id', 'Log.equipment_record_id', 'Log.description'),
			'limit' => 10,
			'order' => array(
				'Log.created' => 'desc'
			),
			'contain' => array(
				'User.username',
				'EquipmentRecord' => array(
					'Fund' => array(
						'name'
					)
				)
			)
		);
		$this->set('logs', $this->paginate('Log', array('Log.member_id'=>$id)));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Member->create();
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Member', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Member->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Member', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Member->del($id)) {
			$this->Session->setFlash(__('Member deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>