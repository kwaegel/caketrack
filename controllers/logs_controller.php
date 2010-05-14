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
			),
			'order' => array(
				'Log.id' => 'desc'
			)
		);
		$this->set('logs', $this->paginate());
	}

	function view($id = null) {
		$this->Log->recursive = 2;
		if (!$id) {
			$this->Session->setFlash('Invalid Log.');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('log', $this->Log->read(null, $id));
	}
}
?>