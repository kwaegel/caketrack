<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="equipmentRecords index">
<h2><?php __('Equipment Records');?></h2>
<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>
</p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
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
			<?php echo $html->link($equipmentRecord['Fund']['name'], array('controller' => 'funds', 'action' => 'view', $equipmentRecord['Fund']['id'])); ?>
		</td>
		<td>
			<?php
				//Debugger::log($equipmentRecord, $level='dev');
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
			<?php 
				$inService = $equipmentRecord['EquipmentRecord']['in_service'];
				if ($inService != '0000-00-00')
				{
					echo $inService;
				}
			
			?>
		</td>
		<td>
			<?php echo $html->link($equipmentRecord['StatusType']['status_type'], array('controller' => 'status_types', 'action' => 'view', $equipmentRecord['StatusType']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($equipmentRecord['Member']['name'], array('controller' => 'members', 'action' => 'view', $equipmentRecord['Member']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $equipmentRecord['EquipmentRecord']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $equipmentRecord['EquipmentRecord']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Add new equipment record', array('action' => 'add')); ?></li>
	</ul>
</div>
