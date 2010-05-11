<?php
class EquipmentRecordsController extends AppController {

	var $name = 'EquipmentRecords';
	var $helpers = array('Html', 'Form', 'Tracking');
	var $components = array('Auth');
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

	function view($id = null) {
		$this->set("CSS", "EquipmentRecord.view.css"); 
	
		$this->EquipmentRecord->recursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid EquipmentRecord.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if (empty($this->data)) {
			$this->EquipmentRecord->contain('Fund', 'EquipmentType', 'StatusType', 'Member');
			$this->data = $this->EquipmentRecord->read(null, $id);
		}
		
		// get logs for item
		// Isn't there some way to get this from the current model?
		// Paginate this with Ajax.
		$log_results = $this->EquipmentRecord->Log->find('all', array('conditions' => array('Log.equipment_record_id' => $id)));
		$this->set('logs', $log_results);
		
		// set vars for drop down form elements
		//$funds = $this->EquipmentRecord->Fund->find('list');
		$members = $this->EquipmentRecord->Member->find('list');
		//$equipmentTypes = $this->EquipmentRecord->EquipmentType->find('list');
		$statusTypes = $this->EquipmentRecord->StatusType->find('list');
		$this->set(compact('statusTypes', 'members'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EquipmentRecord->create();
			
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

			//Debugger::log($this->data['EquipmentRecord'], $level='dev');
			
			if ($this->EquipmentRecord->save($this->data)) {
				$this->Session->setFlash(__('The equipment record has been saved', true));
				$this->redirect(array('action'=>'view', $id));
				//$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The equipment record could not be saved. Please, try again.', true));
			}
		}
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
				//$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The EquipmentRecord could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
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
	
	function getRecordDiff($oldRecord, $newRecord){
		
		// for each data field
		$logString = '';
		foreach($newRecord as $key => $value) {
			if ($value != $oldRecord[$key]) {
				$logString = $logString . $key . ': ' .  $oldRecord[$key] . " changed to " . $newRecord[$key] . "\n";
			}
		}
		
		if ($logString != '') {
			$logString = "Model Changed:\n" . $logString;
		}
		
		return $logString;
		
	}

}
?>