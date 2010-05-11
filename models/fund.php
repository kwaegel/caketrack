<?php
class Fund extends AppModel {

	var $name = 'Fund';

	var $hasMany = array(
		'EquipmentRecord' => array(
			'className'	=> 'EquipmentRecord',
			'foreignKey'	=> 'fund_id'
		)
	);

}
?>