<?php
class EquipmentRecordsController extends AppController {

	var $name = 'EquipmentRecords';
	var $helpers = array('Tracking');
	var $paginate = array(
		'limit' => 20,
		'order' => array(
			'EquipmentRecord.tracking_number' => 'asc'
		)
	);

	function index() {
		$this->EquipmentRecord->recursive = -1;
		$this->paginate = array(
			'contain' => array(
				'Fund',
				'EquipmentType',
				'StatusType',
				'Member'
			)
		);
		$this->set('equipmentRecords', $this->paginate());
	}
	
	function viewUnassigned()
	{
		$records = $this->EquipmentRecord->find('all', array(
			'conditions' => array('status_type_id'=> 1, 'Member.name' => 'None'),
			'contain' => array(
				'Fund',
				'EquipmentType',
				'StatusType',
				'Member'
			),
			'order' => array('EquipmentRecord.equipment_type_id')
		));
		
		$this->set('unassignedRecords', $records);
	}

	function view($id = null) {
		$this->set("CSS", "EquipmentRecord.view.css"); 
	
		$this->EquipmentRecord->recursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid EquipmentRecord.', true));
			$this->redirect(array('action'=>'index'));
			return;
		}
		if (empty($this->data)) {
			$this->EquipmentRecord->contain('Fund', 'EquipmentType', 'StatusType', 'Member');
			$this->data = $this->EquipmentRecord->read(null, $id);
		}
		
		// get logs for item
		$this->paginate = array(
			'fields' => array('Log.created', 'Log.user_id', 'Log.equipment_record_id', 'Log.member_id', 'Log.description'),
			'limit' => 10,
			'order' => array(
				'Log.id' => 'desc'
			),
			'contain' => array(
				'User.username',
				'EquipmentRecord' => array(
					'Fund.name',
					'tracking_number'
				),
				'Member.name'
			)
		);
		$pages = $this->paginate($this->EquipmentRecord->Log, array('Log.equipment_record_id'=>$id));
		$this->set('relatedLogs', $pages);
		
		// set vars for drop down form elements
		$members = $this->EquipmentRecord->Member->find('list');
		$statusTypes = $this->EquipmentRecord->StatusType->find('list');
		$this->set(compact('statusTypes', 'members'));
	}

	function add() {
		if (!empty($this->data)) {
		
			// create a new equipment record
			$this->EquipmentRecord->create();
			
			Debugger::log($this->data, $level='dev');
			
			$tracking_num = $this->data['EquipmentRecord']['tracking_number'];

			// set the fund_id (general if it starts with GF, case insensitive)
			if(preg_match("/^GF/i", $tracking_num)) {
				// if the tracking number indicates a general fund item
				$this->data['EquipmentRecord']['fund_id'] = 2;	// 2 = forign key to 'general'
			} else {
				// if not match is found echo this line
				$this->data['EquipmentRecord']['fund_id'] = 1;	// 1 =  forign key to 'relief'
			}
			
			// strip all non-numeric characters out of the tracking number
			$tracking_num = preg_replace('/\D/', '', $tracking_num);
			
			$this->data['EquipmentRecord']['tracking_number'] = $tracking_num;
			
			// create a log record of this item being added to the system
			$userData = $this->Auth->user();
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  'Equipment entered into the system.',
			);
			
			// if the equipment is being assigned to someone, create a log entry for that
			if (isset($this->data['EquipmentRecord']['member_id']))
			{
				// get the member name
				$memberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.id' => $this->data['EquipmentRecord']['member_id'])));

				// create second log message for assignment
				$logDescription = 'Assigned to ' . $memberRecord['Member']['name'];
				$this->data['Log']['1'] = array(
					'user_id' => $userData['User']['id'],
					'member_id' => $this->data['EquipmentRecord']['member_id'],
					'description' =>  $logDescription,
				);
			}
			
			if ($this->EquipmentRecord->saveAll($this->data, array('validate'=>'first'))) {
				$this->Session->setFlash('Equipment record ' . $tracking_num . ' added');
				$this->redirect(array('action'=>'add'));
				/*
				$equipmentId = $this->EquipmentRecord->getLastInsertId(); 
				$this->redirect(array('action'=>'view', $equipmentId));
				*/
			} else {
				$this->Session->setFlash('The equipment record could not be saved. Please, try again.');
			}
		}
		
		// data to populate dropdown lists
		$funds = $this->EquipmentRecord->Fund->find('list');
		$members = $this->EquipmentRecord->Member->find('list');
		$equipmentTypes = $this->EquipmentRecord->EquipmentType->find('list');
		$statusTypes = $this->EquipmentRecord->StatusType->find('list');
		$this->set(compact('funds','members', 'equipmentTypes', 'statusTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EquipmentRecord', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			/*
			// get diff between new and current model data here?
			//$this->EquipmentRecord->contain('Fund', 'Member', 'StatusType', 'EquipmentType');
			$oldRecord = $this->EquipmentRecord->find('first', array('conditions' => array('EquipmentRecord.id' => $id)));
			
			Debugger::log($oldRecord['EquipmentRecord'], $level='loggingTest');
			Debugger::log($this->data['EquipmentRecord'], $level='loggingTest');
			
			$logMessage = $this->getRecordDiff($oldRecord['EquipmentRecord'], $this->data['EquipmentRecord']);
			Debugger::log($logMessage, $level='loggingTest');
			*/
			
			// create log of this action
			//$this->EquipmentRecord->Log->create();
		
			// validate and save record and log
			if ($this->EquipmentRecord->save($this->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('Equipment record updated', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The EquipmentRecord could not be saved. Please, try again.', true));
			}
		}
		else {
			$this->data = $this->EquipmentRecord->read(null, $id);
		}
		$funds = $this->EquipmentRecord->Fund->find('list');
		$members = $this->EquipmentRecord->Member->find('list');
		$equipmentTypes = $this->EquipmentRecord->EquipmentType->find('list');
		$statusTypes = $this->EquipmentRecord->StatusType->find('list');
		$this->set(compact('funds','members','equipmentTypes','statusTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EquipmentRecord', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EquipmentRecord->del($id)) {
			$this->Session->setFlash(__('EquipmentRecord deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	function search() {
		
		// get key=>value pairs from the url
		$params = $this->params['url'];
		
		// check if we have any url data to parse. The params will always include 
		// the url of the calling view, so check for length > 1.
		if (count($params) > 1)
		{
			$this->set('cakeDebug', $params);
		}
		else
		{
			$this->set('cakeDebug', 'No url data.');
		}
		
		
		
		// build search query
	
	
	
	}
	
	
	/** less general methods **/
	
	function reassign($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Equipment Record request: no ID number.');
			$this->redirect(array('action'=>'index'));
			return;
		}
		
		// get the user authentication data
		$userData = $this->Auth->user(); 
		
		// find the member number for 'none'
		$noneMemberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.name' => 'None')));
		$noneMemberID = $noneMemberRecord['Member']['id'];
		
		// if we are assigning to no one, treat as an usassignment action.
		if ($this->data['EquipmentRecord']['member_id'] == $noneMemberID) {
			$this->unassign($id);
		}
		else
		{
			// store the submitted data
			$submittedData = $this->data;
			
			// get the current equipment data
			$this->data = $this->EquipmentRecord->read(array('member_id', 'status_type_id'));
			
			// merge in $id
			$this->data['EquipmentRecord']['id'] = $id;
			//$this->data = array_merge($this->data, $submittedData);
			
			$oldMemberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.id' => $this->data['EquipmentRecord']['member_id'])));
			
			
			// create first log for unassignment
			if ($this->data['EquipmentRecord']['member_id'] != $noneMemberID)
			{
				$logDescription = 'Unassigned from ' . $oldMemberRecord['Member']['name'];
				$this->data['Log']['0'] = array(
					'user_id' => $userData['User']['id'],
					'member_id' => $this->data['EquipmentRecord']['member_id'],
					'description' =>  $logDescription,
				);
			}
			
			// modify equipment data
			$this->data['EquipmentRecord']['member_id'] = $submittedData['EquipmentRecord']['member_id'];
			
			$newMemberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.id' => $this->data['EquipmentRecord']['member_id'])));
			
			// create second log message for assignment
			$logDescription = 'Assigned to ' . $newMemberRecord['Member']['name'];
			$this->data['Log']['1'] = array(
				'user_id' => $userData['User']['id'],
				'member_id' => $this->data['EquipmentRecord']['member_id'],
				'description' =>  $logDescription,
			);
			
			
			if($this->EquipmentRecord->saveAll($this->data, array('validate'=>'first')))
			{
				$this->Session->setFlash('Equipment record updated');
				$this->autoRender = false;	// don't try to display the empty unassign view
				$this->redirect(array('action'=>'view', $id));
			}
			else
			{
				$this->Session->setFlash('An error occured while updating the record.');
			}
			
		} // end else
	} // end unassign
	
	function unassign($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Equipment Record request: no ID number.');
			$this->redirect(array('action'=>'index'));
		}
		
		// get the user authentication data
		$userData = $this->Auth->user(); 
		
		// get the current equipment data
		$this->data = $this->EquipmentRecord->read(array('member_id'));
		$this->data['EquipmentRecord']['id'] = $id;
		
		// find the member number for 'none'
		$noneMemberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.name' => 'None')));
		$noneMemberID = $noneMemberRecord['Member']['id'];
		$memberRecord = $this->EquipmentRecord->Member->find('first', array('conditions' => array('Member.id' => $this->data['EquipmentRecord']['member_id'])));
		
		// if the equipment is already assigned to no one, do nothing.
		if ($this->data['EquipmentRecord']['member_id'] == $noneMemberID)
		{
			
			$this->Session->setFlash('Equipment record not assigned.');
			$this->autoRender = false;	// don't try to display the empty unassign view
			$this->redirect(array('action'=>'view', $id));
			return;
		}

		// setup log fields
		$logDescription = 'Unassigned from ' . $memberRecord['Member']['name'];
		$this->data['Log']['0'] = array(
			'user_id' => $userData['User']['id'],
			'member_id' => $this->data['EquipmentRecord']['member_id'],
			'description' =>  $logDescription,
		);
		
		// modify equipment data
		$this->data['EquipmentRecord']['member_id'] = $noneMemberRecord['Member']['id'];
		
		if($this->EquipmentRecord->saveAll($this->data, array('validate'=>'first')))
		{
			$this->Session->setFlash('Equipment record updated');
			$this->autoRender = false;	// don't try to display the empty unassign view
			$this->redirect(array('action'=>'view', $id));
		}
		else
		{
			$this->Session->setFlash('An error occured while updating the record.');
		}
	}
	
	// update status
	function updatestatus($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Equipment Record request: no ID number.');
			$this->redirect(array('action'=>'index'));
		}
		// store the submitted data
		$submittedData = $this->data;
		
		// get the user authentication data
		$userData = $this->Auth->user(); 
		
		// get the current equipment data
		$this->data = $this->EquipmentRecord->read(array('id', 'status_type_id'));
		
		// only update if the status type will change
		if ($submittedData['EquipmentRecord']['status_type_id'] != $this->data['EquipmentRecord']['status_type_id'])
		{
			// update the equipment data
			$this->data['EquipmentRecord']['status_type_id'] = $submittedData['EquipmentRecord']['status_type_id'];
			
			// get status type
			$newStatus = $this->EquipmentRecord->StatusType->find('first', array('conditions' => array('StatusType.id' => $this->data['EquipmentRecord']['status_type_id'])));
			
			// create log of status change
			$logDescription = 'Status changed to: ' . $newStatus['StatusType']['status_type'];			
			
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  $logDescription
			);
			
			// save the data
			if($this->EquipmentRecord->saveAll($this->data, array('validate'=>'first')))
			{
				$this->Session->setFlash('Equipment record updated');
				$this->autoRender = false;	// don't try to display the empty updateStatus view
				$this->redirect(array('action'=>'view', $id));
			}
			else
			{
				$this->Session->setFlash('An error occured while updating the record.');
			}
		}
	}

}
?>