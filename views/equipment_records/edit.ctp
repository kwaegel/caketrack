<div class="equipmentRecords form">
<?php echo $form->create('EquipmentRecord');?>
	<fieldset>
 		<legend><?php __('Edit EquipmentRecord');?></legend>
	<?php
		echo $form->input('fund_id');
		echo $form->input('tracking_number');
		echo $form->input('equipment_type_id');
		echo $form->input('serial_number');
		echo $form->input('size');
		echo $form->input('in_service');
		echo $form->input('status_type_id');
		echo $form->input('member_id');
		echo $form->input('comments');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php //cho $html->link(__('Delete', true), array('action' => 'delete', $form->value('EquipmentRecord.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('EquipmentRecord.id'))); ?></li>
		<li><?php //echo $html->link(__('List Equipment Records', true), array('action' => 'index'));?></li>
		<li><?php //echo $html->link(__('List Members', true), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php //echo $html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add')); ?> </li>
		<li><?php //echo $html->link(__('List Equipment Types', true), array('controller' => 'equipment_types', 'action' => 'index')); ?> </li>
		<li><?php //echo $html->link(__('New Equipment Type', true), array('controller' => 'equipment_types', 'action' => 'add')); ?> </li>
		<li><?php //echo $html->link(__('List Status Types', true), array('controller' => 'status_types', 'action' => 'index')); ?> </li>
		<li><?php //echo $html->link(__('New Status Type', true), array('controller' => 'status_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
