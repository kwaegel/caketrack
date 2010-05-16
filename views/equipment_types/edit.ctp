<div class="equipmentTypes form">
<?php echo $form->create('EquipmentType');?>
	<fieldset>
 		<legend><?php echo 'Edit the name of this equipment type';?></legend>
		<p>Note: changing the name of this status type does not change what pieces of equipment are assigned to it. </p>
	<?php
		echo $form->input('id');
		echo $form->input('type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Go back to list', array('action' => 'index'));?></li>
	</ul>
</div>
