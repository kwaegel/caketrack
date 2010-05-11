<?php 
/* SVN FILE: $Id$ */
/* Request Test cases generated on: 2010-01-09 01:51:09 : 1263019869*/
App::import('Model', 'Request');

class RequestTestCase extends CakeTestCase {
	var $Request = null;
	var $fixtures = array('app.request', 'app.member');

	function startTest() {
		$this->Request =& ClassRegistry::init('Request');
	}

	function testRequestInstance() {
		$this->assertTrue(is_a($this->Request, 'Request'));
	}

	function testRequestFind() {
		$this->Request->recursive = -1;
		$results = $this->Request->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Request' => array(
			'id'  => 1,
			'member_id'  => 1,
			'description'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>