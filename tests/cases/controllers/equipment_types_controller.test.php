<?php 
/* SVN FILE: $Id$ */
/* EquipmentTypesController Test cases generated on: 2009-12-31 23:00:56 : 1262318456*/
App::import('Controller', 'EquipmentTypes');

class TestEquipmentTypes extends EquipmentTypesController {
	var $autoRender = false;
}

class EquipmentTypesControllerTest extends CakeTestCase {
	var $EquipmentTypes = null;

	function startTest() {
		$this->EquipmentTypes = new TestEquipmentTypes();
		$this->EquipmentTypes->constructClasses();
	}

	function testEquipmentTypesControllerInstance() {
		$this->assertTrue(is_a($this->EquipmentTypes, 'EquipmentTypesController'));
	}

	function endTest() {
		unset($this->EquipmentTypes);
	}
}
?>