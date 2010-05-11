<div class="funds form">
<?php echo $form->create('Fund');?>
	<fieldset>
 		<legend><?php __('Edit Fund');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Fund.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Fund.id'))); ?></li>
		<li><?php echo $html->link(__('List Funds', true), array('action' => 'index'));?></li>
	</ul>
</div>
