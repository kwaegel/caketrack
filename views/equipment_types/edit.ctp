<div class="equipmentTypes form">
<?php echo $form->create('EquipmentType');?>
	<fieldset>
 		<legend><?php echo 'Edit the name of this equipment type';?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php /*
<div class="actions">
	<ul>
		<li><?php echo $html->link('Delete', array('action' => 'delete', $form->value('EquipmentType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('EquipmentType.id'))); ?></li>
		<li><?php echo $html->link('Go back to equipment types listing', Controller::referer()); ?></li>
		<li><?php echo $html->link('Go back to equipment types listing', array('action' => 'view'));?></li>
	</ul>
</div>
*/
?>
