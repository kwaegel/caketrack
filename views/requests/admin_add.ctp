<div class="requests form">
<?php echo $form->create('Request');?>
	<fieldset>
 		<legend><?php __('Add Request');?></legend>
	<?php
		echo $form->input('member_id');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Requests', true), array('action' => 'index'));?></li>
	</ul>
</div>
