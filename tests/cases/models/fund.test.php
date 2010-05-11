<?php 
/* SVN FILE: $Id$ */
/* Fund Test cases generated on: 2010-01-04 02:39:45 : 1262590785*/
App::import('Model', 'Fund');

class FundTestCase extends CakeTestCase {
	var $Fund = null;
	var $fixtures = array('app.fund', 'app.equipment_record');

	function startTest() {
		$this->Fund =& ClassRegistry::init('Fund');
	}

	function testFundInstance() {
		$this->assertTrue(is_a($this->Fund, 'Fund'));
	}

	function testFundFind() {
		$this->Fund->recursive = -1;
		$results = $this->Fund->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Fund' => array(
			'id'  => 1,
			'name'  => 'Lorem ip'
		));
		$this->assertEqual($results, $expected);
	}
}
?>