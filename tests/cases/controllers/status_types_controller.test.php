<?php 
/* SVN FILE: $Id$ */
/* StatusTypesController Test cases generated on: 2009-12-31 23:00:13 : 1262318413*/
App::import('Controller', 'StatusTypes');

class TestStatusTypes extends StatusTypesController {
	var $autoRender = false;
}

class StatusTypesControllerTest extends CakeTestCase {
	var $StatusTypes = null;

	function startTest() {
		$this->StatusTypes = new TestStatusTypes();
		$this->StatusTypes->constructClasses();
	}

	function testStatusTypesControllerInstance() {
		$this->assertTrue(is_a($this->StatusTypes, 'StatusTypesController'));
	}

	function endTest() {
		unset($this->StatusTypes);
	}
}
?>