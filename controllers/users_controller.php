<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Tracking');
	
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		$this->User->Rrcursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->User->contain('Log', 'Log.EquipmentRecord.Fund');
		$this->set('user', $this->User->read(null, $id));
		
		// get pages of logs
		$this->paginate = array(
			'contain' => array(
				'EquipmentRecord' => array(
					'id',
					'Fund.name',
					'tracking_number'
				),
				'Member'
			)
		);
		$this->set('logs', $this->paginate('Log', array('Log.user_id'=>$id)));
	}
	
	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login','logout','register');
		
		// If logged in, these pages require logout
		if ($this->Auth->user() && in_array($this->params['action'], array('signup', 'login'))) {
			$this->redirect('/');
		}

	}
	
	function login() {
		// No form processing needed, Auth does it automatically
	}

	function logout() {
		$this->redirect($this->Auth->logout());		// don't need a logout.ctp view
	}
	
	function register() {
		if (!empty($this->data)) {
		
			if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['confirm_password'])) {
				$this->User->create();
				
				if ($this->User->save($this->data)){
					$this->Session->setFlash(__('Registration saved', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('Registration error. Please, try again.', true));
				}
				
			}
		}		
	}


}
?>