<div class="statusTypes form">
<?php echo $form->create('StatusType');?>
	
	<fieldset>
 		<legend><?php echo 'Edit status type name';?></legend>
		<p>
		Note: changing the name of this status type does not change it's relationships with other pieces of equipment.
		</p>
	<?php
		echo $form->input('id');
		echo $form->input('status_type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Go back to list', array('action' => 'index'));?></li>
	</ul>
</div>
