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
		<li><?php echo $html->link('List StatusTypes', array('action' => 'index'));?></li>
		<li><?php echo $html->link('List Equipment Records', array('controller' => 'equipment_records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link('New Equipment Record', array('controller' => 'equipment_records', 'action' => 'add')); ?> </li>
	</ul>
</div>
