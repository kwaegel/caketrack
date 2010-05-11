<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="statusTypes view">
<h2><?php  __('StatusType');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusType['StatusType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusType['StatusType']['status_type']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit StatusType', true), array('action' => 'edit', $statusType['StatusType']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete StatusType', true), array('action' => 'delete', $statusType['StatusType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statusType['StatusType']['id'])); ?> </li>
		<li><?php echo $html->link(__('List StatusTypes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New StatusType', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Equipment Records', true), array('controller' => 'equipment_records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Equipment Records');?></h3>
	<div>
	<br />
	<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
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
	foreach ($equipmentRecords as $equipmentRecord):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $equipmentRecord['Fund']['name']; ?>
			</td>
			<td>
				<?php 
					$tracking->makeTrackingLink($equipmentRecord['EquipmentRecord']['id'], $equipmentRecord['Fund']['name'], $equipmentRecord['EquipmentRecord']['tracking_number']);			
				?>
			</td>
			<td>
				<?php echo $html->link($equipmentRecord['EquipmentType']['type'], array('controller' => 'equipment_types', 'action' => 'view', $equipmentRecord['EquipmentType']['id'])); ?>
			</td>
			<td>
				<?php echo $equipmentRecord['EquipmentRecord']['serial_number']; ?>
			</td>
			<td>
				<?php echo $equipmentRecord['EquipmentRecord']['size']; ?>
			</td>
			<td>
				<?php echo $equipmentRecord['EquipmentRecord']['in_service']; ?>
			</td>
			<td>
				<?php echo $html->link($equipmentRecord['StatusType']['status_type'], array('controller' => 'status_types', 'action' => 'view', $equipmentRecord['StatusType']['id'])); ?>
			</td>
			<td>
				<?php echo $html->link($equipmentRecord['Member']['name'], array('controller' => 'members', 'action' => 'view', $equipmentRecord['Member']['id'])); ?>
			</td>
			<!--
			<td>
				<?php //echo $equipmentRecord['EquipmentRecord']['comments']; ?>
			</td>-->
			<td class="actions">
				<?php echo $html->link(__('View', true), array('action' => 'view', $equipmentRecord['EquipmentRecord']['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('action' => 'edit', $equipmentRecord['EquipmentRecord']['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('action' => 'delete', $equipmentRecord['EquipmentRecord']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $equipmentRecord['EquipmentRecord']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>

	</div>
	<div class="paging">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
