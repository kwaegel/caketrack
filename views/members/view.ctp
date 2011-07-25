<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="members view">
<!--<h2><?php  __('Member');?></h2>-->
<h2>Member: <?php echo $member['Member']['name']; ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php //if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $member['Member']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $member['Member']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Name', true), array('action' => 'edit', $member['Member']['id'])); ?> </li>
		<!--<li><?php //echo $html->link(__('Delete Member', true), array('action' => 'delete', $member['Member']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['Member']['id'])); ?> </li>-->
		<li><?php echo $html->link(__('List Members', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('Related Equipment Records');?></h3>
	<div>
	<br />
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('fund');?></th>
		<th><?php echo $paginator->sort('tracking_number');?></th>
		<th><?php echo $paginator->sort('equipment_type_id');?></th>
		<th><?php echo $paginator->sort('serial_number');?></th>
		<th><?php echo $paginator->sort('size');?></th>
		<th><?php echo $paginator->sort('in_service');?></th>
		<th><?php echo $paginator->sort('status_type_id');?></th>
		<th><?php echo $paginator->sort('member_id');?></th>
		<!--<th><?php //echo $paginator->sort('comments');?></th>-->
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($member['EquipmentRecord'] as $equipmentRecord):
	//foreach ($equipmentRecords as $equipmentRecord):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $html->link($equipmentRecord['Fund']['name'], array('controller' => 'funds', 'action' => 'view', $equipmentRecord['Fund']['id'])); ?>
			</td>
			<td>
				<?php 
					$tracking->makeTrackingLink($equipmentRecord['id'], $equipmentRecord['Fund']['name'], $equipmentRecord['tracking_number']);
				?>
			</td>
			<td>
				<?php echo $html->link($equipmentRecord['EquipmentType']['type'], array('controller' => 'equipment_types', 'action' => 'view', $equipmentRecord['EquipmentType']['id'])); ?>
			</td>
			<td>
				<?php echo $equipmentRecord['serial_number']; ?>
			</td>
			<td>
				<?php echo $equipmentRecord['size']; ?>
			</td>
			<td>
				<?php echo $equipmentRecord['in_service']; ?>
			</td>
			<td>
				<?php echo $html->link($equipmentRecord['StatusType']['status_type'], array('controller' => 'status_types', 'action' => 'view', $equipmentRecord['StatusType']['id'])); ?>
			</td>
			<td>
				<?php echo $member['Member']['name']; ?>
			</td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'equipment_records','action' => 'view', $equipmentRecord['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'equipment_records','action' => 'edit', $equipmentRecord['id'])); ?>
				<?php //echo $html->link(__('Delete', true), array('controller' => 'equipment_records','action' => 'delete', $equipmentRecord['EquipmentRecord']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $equipmentRecord['EquipmentRecord']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>

	</div>
	
	<!--
	<div class="actions">
		<ul>
			<li><?php //echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add'));?> </li>
		</ul>
	</div>
	-->
	
	<div class="logs">
	<h3><?php __('Related Logs');?></h3>
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
			<th>Description</th>
		</tr>
		<?php
		$i = 0;
		foreach ($logs as $log):
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
					<?php echo $log['Log']['description']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
	
<?php //$debug->dump($member) ?>
<?php //$debug->dump($logs) ?>
<?php //$debug->dump($equipmentRecords) ?>
	
</div>
