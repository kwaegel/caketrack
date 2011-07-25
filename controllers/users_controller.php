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
		$this->set('relatedLogs', $this->paginate('Log', array('Log.user_id'=>$id) ));
	}
	
	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login','logout','register');
		
		// If logged in, these pages require logout
		if ($this->Auth->user() && in_array($this->params['action'], array('signup', 'login'))) {
			$this->redirect('/');
		}

	}
	
	function beforeRender() {
		parent::beforeRender();
	}
	
	function login() {
		// No form processing needed, Auth does it automatically
	}

	function logout() {
		$this->redirect($this->Auth->logout());		// don't need a logout.ctp view
	}
	
	// Register a new user on the system.
	function register() {
		if (!empty($this->data)) {
		
			if ($this->data['User']['password'] === $this->Auth->password($this->data['User']['confirm_password'])) {				
				// Make all users admins for now.
				$this->data['User']['admin'] = 1;
				
				$this->User->create();
				
				// Create a log recording when this user was added to the system.
				$userAuth = $this->Auth->user();
				
				//$this->log($userAuth, LOG_DEBUG);
				
				$this->data['Log']['0'] = array(
					'user_id' => $userAuth['User']['id'],
					'description' =>  'Added user "'. $this->data['User']['username'] .'" to the system.',
				);
				
				//$this->log($this->data, LOG_DEBUG);
				
				
				if ($this->User->saveAll($this->data)){
				
					$this->log($this->data, LOG_DEBUG);
					
					$this->Session->setFlash('Registration saved');
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash('Registration error. Please, try again.');
				}
			}
		}		
	}
	
	function delete() {
	}


}
?>