<?php 
/* SVN FILE: $Id$ */
/* Log Test cases generated on: 2010-01-03 03:21:44 : 1262506904*/
App::import('Model', 'Log');

class LogTestCase extends CakeTestCase {
	var $Log = null;
	var $fixtures = array('app.log', 'app.user', 'app.equipment_record', 'app.member');

	function startTest() {
		$this->Log =& ClassRegistry::init('Log');
	}

	function testLogInstance() {
		$this->assertTrue(is_a($this->Log, 'Log'));
	}

	function testLogFind() {
		$this->Log->recursive = -1;
		$results = $this->Log->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Log' => array(
			'id'  => 1,
			'timestamp'  => 1,
			'user_id'  => 1,
			'equipment_record_id'  => 1,
			'member_id'  => 1,
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'comment'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'statement'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		));
		$this->assertEqual($results, $expected);
	}
}
?>