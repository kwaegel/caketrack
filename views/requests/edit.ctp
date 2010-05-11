<div class="requests form">
<?php echo $form->create('Request');?>
	<fieldset>
 		<legend><?php __('Edit Request');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('member_id');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Request.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Request.id'))); ?></li>
		<li><?php echo $html->link(__('List Requests', true), array('action' => 'index'));?></li>
	</ul>
</div>
