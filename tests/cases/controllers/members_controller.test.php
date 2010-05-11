<?php 
/* SVN FILE: $Id$ */
/* MembersController Test cases generated on: 2009-12-31 22:52:51 : 1262317971*/
App::import('Controller', 'Members');

class TestMembers extends MembersController {
	var $autoRender = false;
}

class MembersControllerTest extends CakeTestCase {
	var $Members = null;

	function startTest() {
		$this->Members = new TestMembers();
		$this->Members->constructClasses();
	}

	function testMembersControllerInstance() {
		$this->assertTrue(is_a($this->Members, 'MembersController'));
	}

	function endTest() {
		unset($this->Members);
	}
}
?>