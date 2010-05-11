<?php 
/* SVN FILE: $Id$ */
/* EquipmentRecord Fixture generated on: 2010-01-04 03:25:46 : 1262593546*/

class EquipmentRecordFixture extends CakeTestFixture {
	var $name = 'EquipmentRecord';
	var $table = 'equipment_records';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'fund_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'tracking_number' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'equipment_type_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'serial_number' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'size' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'in_service' => array('type'=>'date', 'null' => false, 'default' => NULL),
		'status_type_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'member_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'comments' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'status_type_id' => array('column' => 'status_type_id', 'unique' => 0), 'member_id' => array('column' => 'member_id', 'unique' => 0), 'fund_id' => array('column' => 'fund_id', 'unique' => 0), 'equipment_type_id' => array('column' => 'equipment_type_id', 'unique' => 0))
	);
	var $records = array(array(
		'id'  => 1,
		'fund_id'  => 1,
		'tracking_number'  => 1,
		'equipment_type_id'  => 1,
		'serial_number'  => 'Lorem ipsum dolor sit amet',
		'size'  => 'Lorem ipsum dolor sit amet',
		'in_service'  => '2010-01-04',
		'status_type_id'  => 1,
		'member_id'  => 1,
		'comments'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
	));
}
?>