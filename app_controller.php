<?php
class AppController extends Controller {
	var $components = array('Auth', 'Session', 'RequestHandler');

	var $helpers = array('Html', 'Js'=>'Jquery', 'Form', 'Debug', 'Session');
 
	function beforeFilter() {
	    //Configure AuthComponent
	    //$this->Auth->authorize = 'actions';
	    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
	    $this->Auth->loginRedirect = array('controller' => 'equipment_records', 'action' => 'index');
		//$this->Auth->loginError = 'No username and password was found with that combination.';
	    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
	}
	
	function beforeRender() {
		$this->set('user', $this->Auth->user());
		// In the views $user['User']['username'] would display the logged in users username
	}
	
}
?>