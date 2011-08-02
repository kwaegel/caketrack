<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend>Edit Member Record</legend>
		
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Update Name');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('List Members', array('action' => 'index'));?></li>
	</ul>
</div>