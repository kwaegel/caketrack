<?php
class StatusType extends AppModel {
	var $name = 'StatusType';
	var $displayField = 'status_type';
	var $hasMany = 'EquipmentRecord';   
}
?>