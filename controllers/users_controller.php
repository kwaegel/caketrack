<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Tracking');
	
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
		$pages = $this->paginate($this->User->Log, array('Log.user_id'=>$id));
		$this->set('relatedLogs', $pages);
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
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('No user specified');
			$this->redirect(array('action'=>'index'));
		}
		
		if (empty($this->data))
		{
			$this->data = $this->User->findById($id);
		}
		else	// Save new data
		{
			// Get old record before save to log changes.
			$oldRecord = $this->User->findById($this->data['User']['id']);
			
			// Create a log record of the name change
			$oldName = $oldRecord['User']['username'];
			$newName = $this->data['User']['username'];
			
			$userData = $this->Auth->user();
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  'Changed name of user "'. $oldName .'" to "' . $newName.'".',
			);
		
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash('User name has been updated.');
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash('The User name could not be changed. Please, try again.');
			}
		}
	}
	
	function makeAdmin($id = null) {
		$isAdmin = $this->Auth->user('admin') == true;
		$adminName = $this->Auth->user('username');
		
		if ($id && $isAdmin) {
			$this->data = $this->User->findById($id);
			$username = $this->data['User']['username'];
			
			// Change password
			$this->data['User']['admin'] = 1;
			
			// Record the password reset
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  '"'. $username .'" was promoted to administrator by"' . $adminName . '".',
			);
			
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash('User is now an administrator.');
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash('The user could not be promoted. Please try again.');
			}
		}
	}
	
	function revokeAdmin($id = null) {
		$isAdmin = $this->Auth->user('admin') == true;
		$adminName = $this->Auth->user('username');
		
		if ($id && $isAdmin) {
			$this->data = $this->User->findById($id);
			$username = $this->data['User']['username'];
			
			// Change password
			$this->data['User']['admin'] = 0;
			
			// Record the password reset
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  '"'. $username .'" had administrative privileges revoked by "' . $adminName . '".',
			);
			
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash('User is now an administrator.');
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash('The user could not be promoted. Please try again.');
			}
		}
	}
	
	function changePassword($id = null) {
		// Load user data
		
		if($id)
		{
			$userData = $this->User->findById($id);
			$isCorrectUser = ($this->Auth->user('id') == $userData['User']['id']);
			
			$oldPassword = $this->Auth->password($this->data['User']['oldPassword']);
			$isCorrectPassword = ($oldPassword == $userData['User']['password'] );
			
			if ($isCorrectUser && $isCorrectPassword) {
				
				// Change password
				if($this->data['User']['newPassword'] == $this->data['User']['confirmNewPassword'])
				{
					$userData['User']['password'] = $this->data['User']['newPassword'];
					$userData = $this->Auth->hashPasswords($userData);
					
					if ($this->User->saveAll($userData)) {
						$this->Session->setFlash('Password has been changed.');
						$this->redirect(array('action'=>'view', $id));
					} else {
						$this->Session->setFlash('The password could not be changed. Please try again.');
					}
				}
			}
			else
			{
				$this->Session->setFlash('Old password incorrect.');
			}
		}
	}
	
	function resetPassword($id = null) {
	
		$isAdmin = $this->Auth->user('admin') == true;
		$adminName = $this->Auth->user('username');
		
		if ($id && $isAdmin) {
			$this->data = $this->User->findById($id);
			$username = $this->data['User']['username'];
			
			// Change password
			$this->data['User']['password'] = $username;
			$this->data = $this->Auth->hashPasswords($this->data);
			
			// Record the password reset
			$this->data['Log']['0'] = array(
				'user_id' => $userData['User']['id'],
				'description' =>  '"'. $username .'" had their password reset by"' . $adminName . '".',
			);
			
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash('Password has been reset.');
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash('The password could not be reset. Please try again.');
			}
		}
	}
	
	// Register a new user on the system.
	function register() {
		if (!empty($this->data)) {
		
			if ($this->data['User']['password'] === $this->Auth->password($this->data['User']['confirm_password'])) {				
				// Make all users admins for now.
				$this->data['User']['admin'] = 1;
				
				$this->User->create();
				
				// Create a log recording when this user was added to the system.
				$userAuthId = $this->Auth->user('id');
				
				$this->log($this->Auth->user(), LOG_DEBUG);
				
				$this->data['Log']['0'] = array(
					'user_id' => $userAuthId,
					'description' =>  'Added user "'. $this->data['User']['username'] .'" to the system.',
				);
				
				
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