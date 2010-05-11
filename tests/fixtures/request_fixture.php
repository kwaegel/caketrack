<?php 
/* SVN FILE: $Id$ */
/* Request Fixture generated on: 2010-01-09 01:51:09 : 1263019869*/

class RequestFixture extends CakeTestFixture {
	var $name = 'Request';
	var $table = 'requests';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'member_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'description' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'member_id' => array('column' => 'member_id', 'unique' => 0))
	);
	var $records = array(array(
		'id'  => 1,
		'member_id'  => 1,
		'description'  => 'Lorem ipsum dolor sit amet'
	));
}
?>