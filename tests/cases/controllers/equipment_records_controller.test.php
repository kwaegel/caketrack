<?php 
/* SVN FILE: $Id$ */
/* EquipmentRecordsController Test cases generated on: 2009-12-31 22:46:39 : 1262317599*/
App::import('Controller', 'EquipmentRecords');

class TestEquipmentRecords extends EquipmentRecordsController {
	var $autoRender = false;
}

class EquipmentRecordsControllerTest extends CakeTestCase {
	var $EquipmentRecords = null;

	function startTest() {
		$this->EquipmentRecords = new TestEquipmentRecords();
		$this->EquipmentRecords->constructClasses();
	}

	function testEquipmentRecordsControllerInstance() {
		$this->assertTrue(is_a($this->EquipmentRecords, 'EquipmentRecordsController'));
	}

	function endTest() {
		unset($this->EquipmentRecords);
	}
}
?>