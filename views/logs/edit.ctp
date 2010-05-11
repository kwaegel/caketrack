<div class="logs form">
<?php echo $form->create('Log');?>
	<fieldset>
 		<legend><?php __('Edit Log');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('timestamp');
		echo $form->input('user_id');
		echo $form->input('equipment_record_id');
		echo $form->input('member_id');
		echo $form->input('description');
		echo $form->input('comment');
		echo $form->input('statement');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Log.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Log.id'))); ?></li>
		<li><?php echo $html->link(__('List Logs', true), array('action' => 'index'));?></li>
	</ul>
</div>
