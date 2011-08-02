<div class="equipmentRecords view">
	<h2>
		<?php echo 'Equipment Record'; ?>: <?php $tracking->makeTrackingString($this->data['Fund']['name'], $this->data['EquipmentRecord']['tracking_number']); ?>
	</h2>
	<div class="equipmentRecordData">
		<?php $i = 0; $class = ' class="altrow"';?>
		
		<div class="dataField">
			<h4><?php echo 'Equipment #'; ?></h4>
			<p class="field_value">
				<?php
					$fund = $this->data['Fund']['name'];
					$num = $this->data['EquipmentRecord']['tracking_number'];
					if ($fund == 'general')
						echo 'GF ' . $num;
					else
						echo $num;
				?>
			</p>
		</div>
		<div class="dataField">
			<h4><?php echo 'Equipment Type'; ?></h4>
			<p>
				<?php echo $html->link($this->data['EquipmentType']['type'], array('controller' => 'equipment_types', 'action' => 'view', $this->data['EquipmentType']['id'])); ?>
			</p>
		</div>
		<?php if($this->data['EquipmentRecord']['serial_number']): ?>
		<div class="dataField">
			<h4><?php __('Serial Number'); ?></h4>
			<p><?php echo $this->data['EquipmentRecord']['serial_number']; ?></p>
		</div>
		<?php endif; ?>
		<div class="dataField">
			<h4><?php __('Size'); ?></h4>
			<p><?php echo $this->data['EquipmentRecord']['size']; ?></p>
		</div>
		<div class="dataField">
			<h4><?php __('In Service'); ?></h4>
			<p><?php echo $this->data['EquipmentRecord']['in_service']; ?></p>
		</div>
		<div class="dataField">
			<h4><?php __('Status'); ?></h4>
			<p>
				<?php echo $html->link($this->data['StatusType']['status_type'], array('controller' => 'status_types', 'action' => 'view', $this->data['StatusType']['id'])); ?>
			</p>
		</div>
		<div class="dataField">
			<h4><?php __('Member'); ?></h4>
			<p>
				<?php echo $html->link($this->data['Member']['name'], array('controller' => 'members', 'action' => 'view', $this->data['Member']['id'])); ?>
			</p>
		</div>
	</div>
</div>
<div class="actions">
	<?php
	if ($this->data['Member']['name'] != 'None') {
		echo "\t".'<div class="ActionForm">';
		echo $form->create('EquipmentRecord', array('action' => 'unassign'));
		echo $form->end('Unassign');
		echo "\t</div>";
	}
	?>
	<div class="ActionForm">
	<?php echo $form->create('EquipmentRecord', array('action' => 'reassign'));?>
	<?php echo $form->input('member_id'); ?>
	<?php echo $form->end('Change Assignment');?>
	</div>
	
	<div class="ActionForm">
	<?php echo $form->create('EquipmentRecord', array('action' => 'updatestatus'));?>
	<?php echo $form->input('status_type_id'); ?>
	<?php echo $form->end('Change Status');?>
	</div>


	<ul>
		<li><?php echo $html->link(__('Edit Equipment Information', true), array('action' => 'edit', $this->data['EquipmentRecord']['id'])); ?> </li>
	</ul>
</div>

<div class="logs">
	<h3>Equipment History</h3>
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
