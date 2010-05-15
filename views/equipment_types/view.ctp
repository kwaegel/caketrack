<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="equipmentTypes view">
<h2><?php  echo 'Equipment type: ' . $equipmentType['EquipmentType']['type'];?></h2>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Edit equipment type name', array('action' => 'edit', $equipmentType['EquipmentType']['id'])); ?> </li>
		<li><?php echo $html->link('List equipment types', array('action' => 'index')); ?> </li>
		<li><?php echo $html->link('New equipment type', array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo 'Related Equipment Records';?></h3>
	<div>
	<br />
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
		<th><?php echo $paginator->sort('serial_number');?></th>
		<th><?php echo $paginator->sort('size');?></th>
		<th><?php echo $paginator->sort('in_service');?></th>
		<th><?php echo $paginator->sort('status_type_id');?></th>
		<th><?php echo $paginator->sort('Assigned to', 'member_id');?></th>
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
					$tracking->makeTrackingLink($equipmentRecord['EquipmentRecord']['id'], $equipmentRecord['Fund']['name'], $equipmentRecord['EquipmentRecord']['tracking_number']);			
				?>
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
		</tr>
	<?php endforeach; ?>
	</table>

	</div>
	
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Equipment Record', true), array('controller' => 'equipment_records', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
