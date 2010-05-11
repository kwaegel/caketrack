<?php 
/* SVN FILE: $Id$ */
/* LogsController Test cases generated on: 2010-01-03 03:32:18 : 1262507538*/
App::import('Controller', 'Logs');

class TestLogs extends LogsController {
	var $autoRender = false;
}

class LogsControllerTest extends CakeTestCase {
	var $Logs = null;

	function startTest() {
		$this->Logs = new TestLogs();
		$this->Logs->constructClasses();
	}

	function testLogsControllerInstance() {
		$this->assertTrue(is_a($this->Logs, 'LogsController'));
	}

	function endTest() {
		unset($this->Logs);
	}
}
?>