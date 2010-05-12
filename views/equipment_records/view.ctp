<div class="equipmentRecords view">
	<h2>
		<?php __('Equipment Record');?>: <?php $tracking->makeTrackingString($this->data['Fund']['name'], $this->data['EquipmentRecord']['tracking_number']); ?>
	</h2>
	<div class="equipmentRecordData">
		<?php $i = 0; $class = ' class="altrow"';?>
		
		<div class="dataField">
			<h4><?php __('Equipment #'); ?></h4>
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
		<?php /*
		<div class="dataField">
			<h4><?php __('Fund'); ?></h4>
			<p class="field_value"><?php echo ucwords($this->data['Fund']['name']); ?></p>
		</div>
		*/?>
		<?php /*
		<div class="dataField">
			<h4><?php __('Tracking #'); ?></h4>
			<p><?php echo $this->data['EquipmentRecord']['tracking_number']; ?></p>
		</div>
		*/
		?>
		<div class="dataField">
			<h4><?php __('Equipment Type'); ?></h4>
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
			
			<?php //echo $form->create('EquipmentRecord', array('action' => 'edit'));?>
				<?php //echo $form->input('status_type_id'); ?>
			<?php //echo $form->end('Change Status');?>
			
		</div>
		<div class="dataField">
			<h4><?php __('Member'); ?></h4>
			<p>
				<?php echo $html->link($this->data['Member']['name'], array('controller' => 'members', 'action' => 'view', $this->data['Member']['id'])); ?>
			</p>
			
			<?php //echo $form->create('EquipmentRecord', array('action' => 'edit'));?>
				<?php //echo $form->input('member_id'); ?>
			<?php //echo $form->end('Change Member');?>
		</div>
	</div>
</div>
<div class="actions">
	<div class="ActionForm">
	<?php
		echo $form->create('EquipmentRecord', array('action' => 'unassign'));
		echo $form->end('Unassign');
	?>
	</div>
	<div class="ActionForm">
	<?php echo $form->create('EquipmentRecord', array('action' => 'reassign'));?>
	<?php echo $form->input('member_id'); ?>
	<?php echo $form->end('Change Member');?>
	</div>
	
	<div class="ActionForm">
	<?php echo $form->create('EquipmentRecord', array('action' => 'changestatus'));?>
	<?php echo $form->input('status_type_id'); ?>
	<?php echo $form->end('Change Status');?>
	</div>


	<ul>
		<li><?php echo $html->link(__('Edit Full Equipment Record', true), array('action' => 'edit', $this->data['EquipmentRecord']['id'])); ?> </li>
	</ul>
</div>

<div class="related">
	<h3>History</h3>
	<div class="logs">
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
					<?php echo $html->link($log['User']['username'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
				</td>
				<td>
					<?php
						$tracking->makeTrackingString($this->data['Fund']['name'], $this->data['EquipmentRecord']['tracking_number']);
					?>
				</td>
				
				<td>
					<?php echo $log['Log']['description']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
	
	<?php $debug->dump($this->data); ?>
	
</div>
