<?php 
/* SVN FILE: $Id$ */
/* Log Fixture generated on: 2010-01-03 03:21:44 : 1262506904*/

class LogFixture extends CakeTestFixture {
	var $name = 'Log';
	var $table = 'logs';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'timestamp' => array('type'=>'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'equipment_record_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'member_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'comment' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'statement' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0), 'equipment_record_id_2' => array('column' => 'equipment_record_id', 'unique' => 0), 'member_id' => array('column' => 'member_id', 'unique' => 0))
	);
	var $records = array(array(
		'id'  => 1,
		'timestamp'  => 1,
		'user_id'  => 1,
		'equipment_record_id'  => 1,
		'member_id'  => 1,
		'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'comment'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'statement'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
	));
}
?>