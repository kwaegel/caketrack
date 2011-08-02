<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend>Edit User Account</legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
	?>
	</fieldset>
<?php echo $form->end('Update Name');?>
</div>
<div class="actions">
	<ul>
		<!--<li>
		<?php //echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.id'))); ?>
		</li>-->
		<li><?php echo $html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Logs', true), array('controller' => 'logs', 'action' => 'index')); ?> </li>
		<?php
			if ($this->Session->read('Auth.User.admin') == true) {
				echo '<li>', $html->link(
					'Reset password', 
					array('action' => 'resetPassword', $this->data['User']['id']),
					null,
					//'Are you sure you want to reset the password of ' $this->data['User']['username']
					sprintf('Are you sure you want to reset the password of user "%s"?', $this->data['User']['username'])
					), '</li>';
			}
		?>
	</ul>
</div>
