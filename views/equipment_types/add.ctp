<div class="equipmentTypes form">
<?php echo $form->create('EquipmentType');?>
	<fieldset>
 		<legend><?php __('Add EquipmentType');?></legend>
	<?php
		echo $form->input('type');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Go back to equipment types list', array('action' => 'index'));?></li>
	</ul>
</div>
