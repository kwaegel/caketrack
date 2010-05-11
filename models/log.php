<?php
class Log extends AppModel {

	var $name = 'Log';
	
	var $recursive = 0;

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EquipmentRecord' => array(
			'className' => 'EquipmentRecord',
			'foreignKey' => 'equipment_record_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>