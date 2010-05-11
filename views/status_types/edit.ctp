<div class="statusTypes form">
<?php echo $form->create('StatusType');?>
	<fieldset>
 		<legend><?php __('Edit StatusType');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('status_type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('StatusType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('StatusType.id'))); ?></li>
		<li><?php echo $html->link(__('List StatusTypes', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Equipment Records', true), array('controller' => 'equipment_records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add')); ?> </li>
	</ul>
</div>
