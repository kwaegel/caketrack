<div class="logs form">
<?php echo $form->create('Log');?>
	<fieldset>
 		<legend><?php __('Add Log');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Logs', true), array('action' => 'index'));?></li>
	</ul>
</div>
