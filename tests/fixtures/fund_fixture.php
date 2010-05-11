<?php 
/* SVN FILE: $Id$ */
/* Fund Fixture generated on: 2010-01-04 02:39:45 : 1262590785*/

class FundFixture extends CakeTestFixture {
	var $name = 'Fund';
	var $table = 'funds';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fund' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ip'
	));
}
?>