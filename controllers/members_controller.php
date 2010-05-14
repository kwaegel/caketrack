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
		
		// get pages of all logs related to this member
		$this->paginate = array(
			'fields' => array('Log.created', 'Log.user_id', 'Log.equipment_record_id', 'Log.description'),
			'limit' => 10,
			'order' => array(
				'Log.id' => 'desc'
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
			
			// create a log record of this member being added to the system
			$userData = $this->Auth->user();
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  'Added '. $this->data['Member']['name'] .' to the system.',
			);
			
			// save all data
			if ($this->Member->saveAll($this->data)) {
				$this->Session->setFlash('New member added');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The Member could not be saved. Please, try again.');
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