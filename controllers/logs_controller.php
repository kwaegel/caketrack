<?php
class LogsController extends AppController {

	var $name = 'Logs';
	var $helpers = array('Tracking', 'Js', 'Paginator');
	var $components = array('RequestHandler'); 
	
	var $paginate = array(
		'contain' => array(
				'User',
				'EquipmentRecord' => array(
					'id',
					'Fund',
					'tracking_number'
					
				),
				'Member'
		),
		'limit' => 20,
		'order' => array(
			'Log.id' => 'desc'
		)
	);

	function index() {
		$logs = $this->paginate('Log');
		$this->set('logs', $logs);
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