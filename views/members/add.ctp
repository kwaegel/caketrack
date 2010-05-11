<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend><?php __('Add Member');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Members', true), array('action' => 'index'));?></li>
	</ul>
</div>
