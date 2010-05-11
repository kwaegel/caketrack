<?php
class User extends AppModel {

	var $name = 'User';
	var $displayField = 'username';
	
	var $hasMany = array(
		'Log' => array(
			'className' 	=> 'Log',
			'order' => 'Log.created DESC',
			'foreignKey'   => 'user_id'
		)
	);
	
	function validateLogin($data)
	{
		$user = $this->find(array('username' => $data['username'], 'password' => sha1($data['password'])), array('id', 'username'));
		if(empty($user) == false)
			return $user['User'];
		return false;
	}

}
?>