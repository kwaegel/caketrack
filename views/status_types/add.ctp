<div class="statusTypes form">
<?php echo $form->create('StatusType');?>
	<fieldset>
 		<legend><?php __('Add StatusType');?></legend>
	<?php
		echo $form->input('status_type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List StatusTypes', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Equipment Records', true), array('controller' => 'equipment_records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add')); ?> </li>
	</ul>
</div>
