<?php
class AppController extends Controller {
	var $components = array('Auth', 'Session', 'RequestHandler');

	var $helpers = array('Html','Debug', 'Javascript', 'Session');
 
	function beforeFilter() {
	    //Configure AuthComponent
	    //$this->Auth->authorize = 'actions';
	    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
	    $this->Auth->loginRedirect = array('controller' => 'equipment_records', 'action' => 'index');
	    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
	}
	
}
?>