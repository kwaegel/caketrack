<div class="funds form">
<?php echo $form->create('Fund');?>
	<fieldset>
 		<legend><?php __('Add Fund');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Funds', true), array('action' => 'index'));?></li>
	</ul>
</div>
