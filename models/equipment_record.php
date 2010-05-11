<?php
class EquipmentRecord extends AppModel {

	var $name = 'EquipmentRecord';

	var $belongsTo = array(
		'Fund' => array(
			'className' => 'Fund',
			'foreignKey' => 'fund_id',
		),
		'EquipmentType' => array(
			'className' => 'EquipmentType',
			'foreignKey' => 'equipment_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'StatusType' => array(
			'className' => 'StatusType',
			'foreignKey' => 'status_type_id',
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

	var $hasMany = array(
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'equipment_record_id',
			'dependent' => false,
			'order' => 'Log.created DESC'
		)
	);
	
	var $validate = array(
		'tracking_number' => array(
			'rule' => 'numeric',  
			'message' => 'Tracking number not well formed.'
		),
		'in_service' => array(
			'rule' => 'date',
			'message' => 'Invalid date',
			'allowEmpty' => true

		)

	);
	
}
?>