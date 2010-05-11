<?php 
/* SVN FILE: $Id$ */
/* FundsController Test cases generated on: 2010-01-04 02:54:02 : 1262591642*/
App::import('Controller', 'Funds');

class TestFunds extends FundsController {
	var $autoRender = false;
}

class FundsControllerTest extends CakeTestCase {
	var $Funds = null;

	function startTest() {
		$this->Funds = new TestFunds();
		$this->Funds->constructClasses();
	}

	function testFundsControllerInstance() {
		$this->assertTrue(is_a($this->Funds, 'FundsController'));
	}

	function endTest() {
		unset($this->Funds);
	}
}
?>