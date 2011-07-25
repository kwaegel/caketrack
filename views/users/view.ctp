<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Admin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['admin']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<!--<li><?php echo $html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>-->
		<li><?php echo $html->link(__('User List', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('View All Logs', true), array('controller' => 'logs', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Logs');?></h3>
	<?php if (!empty($relatedLogs)): ?>
	<div class="paging">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('Id'); ?></th>
			<th><?php __('Created'); ?></th>
			<th><?php __('Equipment Record Id'); ?></th>
			<th><?php __('Member Id'); ?></th>
			<th><?php __('Description'); ?></th>
			<th><?php __('Comment'); ?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
	<?php
		$i = 0;
		foreach ($relatedLogs as $log):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $log['Log']['id'];?></td>
			<td><?php echo $log['Log']['created'];?></td>
			<td>
				<?php
				if (isset($log['EquipmentRecord']['Fund']))
				{
					$tracking->makeTrackingLink($log['EquipmentRecord']['id'], $log['EquipmentRecord']['Fund']['name'], $log['EquipmentRecord']['tracking_number']);			
				}
				?>
			</td>
			<td>
				<?php echo $html->link($log['Member']['name'], array('controller' => 'members', 'action' => 'view', $log['Member']['id'])); ?>
			</td>
			<td><?php echo $log['Log']['description'];?></td>
			<td><?php echo $log['Log']['comment'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'logs', 'action' => 'view', $log['Log']['id'])); ?>
				<?php //echo $html->link(__('Edit', true), array('controller' => 'logs', 'action' => 'edit', $log['id'])); ?>
				<?php //echo $html->link(__('Delete', true), array('controller' => 'logs', 'action' => 'delete', $log['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $log['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>

<?php //$debug->dump($logs); ?>
