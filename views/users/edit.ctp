<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend>Edit Username</legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
	?>
	</fieldset>
<?php echo $form->end('Update Name');?>
</div>

<div class="users form">
<?php echo $form->create('User', array('action'=>'changePassword'));?>
	<fieldset>
 		<legend>Change Password</legend>
	<?php
		echo $form->input('id');
		echo $form->input('oldPassword', array('type'=>'password'));
		echo $form->input('newPassword', array('type'=>'password'));
		echo $form->input('confirmNewPassword', array('type'=>'password'));
	?>
	</fieldset>
<?php echo $form->end('Change password');?>
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
					
				if ($this->data['User']['admin'] == true)
				{
					echo '<li>', $html->link(
						'Revoke Administrative Privileges', 
						array('action' => 'revokeAdmin', $this->data['User']['id']),
						null,
						//'Are you sure you want to reset the password of ' $this->data['User']['username']
						sprintf('Are you sure you want to revoke the administrative privileges of "%s"?', $this->data['User']['username'])
						), '</li>';
				}
				else
				{
					echo '<li>', $html->link(
						'Make Administrator', 
						array('action' => 'makeAdmin', $this->data['User']['id']),
						null,
						//'Are you sure you want to reset the password of ' $this->data['User']['username']
						sprintf('Are you sure you want to promote "%s" to administrator?', $this->data['User']['username'])
						), '</li>';
				}
			}
		?>
	</ul>
</div>
