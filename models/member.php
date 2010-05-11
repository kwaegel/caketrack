<?php
class Member extends AppModel {

	var $name = 'Member';
	var $displayField = 'name';
	
	var $hasMany = array(
		'Log' => array(
			'className' 	=> 'Log',
			'order' => 'Log.created DESC',
			'foreignKey'   => 'member_id'
		),
		'EquipmentRecord' => array(
			'className'	=> 'EquipmentRecord',
			'foreignKey'	=> 'member_id'
		)
	
	);
}
?>