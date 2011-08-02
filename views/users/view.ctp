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

<div class="logs">
	<h3>History</h3>
	<div class="paging">
		<?php $paginator->options(array('update' => 'content', 'indicator' => 'spinner')); ?>
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
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Created</th>
		<th>Updated by</th>
		<th>ID affected</th>
		<th>Member affected</th>
		<th>Description</th>
	</tr>
	<?php
	$i = 0;
	foreach ($relatedLogs as $log):
	//foreach ($member['Log'] as $log):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $log['Log']['created']; ?>
			</td>
			<td>
				<?php echo $html->link($log['User']['username'], array('controller' => 'users', 'action' => 'view', $log['Log']['user_id'])); ?>
			</td>
			<td>
			<?php
				if (isset($log['EquipmentRecord']['tracking_number']))
				{
					//echo $html->link($log['equipment_record_id'], array('controller' => 'equipment_records', 'action' => 'view', $log['EquipmentRecord']['id']));
					$tracking->makeTrackingLink($log['Log']['equipment_record_id'], $log['EquipmentRecord']['Fund']['name'], $log['EquipmentRecord']['tracking_number']);			
				}
			?>
			</td>
			<td>
			<?php
				if(isset($log['EquipmentRecord']['member_id']) || true)
				{
					echo $html->link($log['Member']['name'], array('controller' => 'members', 'action' => 'view', $log['Log']['member_id']));
				}
			?>
			</td>
			<td>
				<?php echo $log['Log']['description']; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>
