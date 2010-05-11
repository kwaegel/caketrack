<?php 
/* SVN FILE: $Id$ */
/* EquipmentRecord Test cases generated on: 2010-01-04 03:25:46 : 1262593546*/
App::import('Model', 'EquipmentRecord');

class EquipmentRecordTestCase extends CakeTestCase {
	var $EquipmentRecord = null;
	var $fixtures = array('app.equipment_record', 'app.fund', 'app.equipment_type', 'app.status_type', 'app.member', 'app.log');

	function startTest() {
		$this->EquipmentRecord =& ClassRegistry::init('EquipmentRecord');
	}

	function testEquipmentRecordInstance() {
		$this->assertTrue(is_a($this->EquipmentRecord, 'EquipmentRecord'));
	}

	function testEquipmentRecordFind() {
		$this->EquipmentRecord->recursive = -1;
		$results = $this->EquipmentRecord->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('EquipmentRecord' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>