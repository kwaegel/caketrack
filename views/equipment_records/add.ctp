<div class="equipmentRecords form">
<?php echo $form->create('EquipmentRecord');?>
	<fieldset>
 		<legend><?php __('Add an equipment record');?></legend>
	<?php
		//echo $form->input('fund_id');
		echo '<p>Next available general id: <strong>GF ' . $nextAvailableTrackingNumber['general'] . "</strong></p>";
		echo '<p>Next available relief id: <strong>' . $nextAvailableTrackingNumber['relief'] . "</strong></p>";
		echo $form->input('tracking_number');
		echo $form->input('equipment_type_id');
		echo $form->input('serial_number');
		echo $form->input('size');
		echo $form->input('in_service');
		echo $form->input('status_type_id');
		echo $form->input('member_id', array('default' => $noneId));
		echo $form->input('comments');
	?>
	</fieldset>
<?php echo $form->end('Add Record');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List EquipmentRecords', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Members', true), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Equipment Types', true), array('controller' => 'equipment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Equipment Type', true), array('controller' => 'equipment_types', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Status Types', true), array('controller' => 'status_types', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Status Type', true), array('controller' => 'status_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
