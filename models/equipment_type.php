<?php
class EquipmentType extends AppModel {
	var $name = 'EquipmentType';
	var $displayField = 'type';	
	var $hasMany = 'EquipmentRecord';   
}
?>