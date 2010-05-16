<?php
	// ensure arguments are passed through urls correctly
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="logs index">
<h2><?php __('Logs');?></h2>
<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>
</p>
<div class="paging">
	<?php 
	$paginator->options(array(
		'update' => '#content', 
		'evalScripts' => true,
		'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
		'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
	));
	echo $paginator->prev('<< Previous', null, null, array('class'=>'disabled')) . ' ';
	echo $paginator->numbers() . ' ';
	echo $paginator->next('Next >>', null, null, array('class' => 'disabled'));
	?>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('equipment_record_id');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
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
			<?php echo $log['Log']['id']; ?>
		</td>
		<td>
			<?php echo $log['Log']['created']; ?>
		</td>
		<td>
			<?php echo $html->link($log['User']['username'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
		</td>
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
		<td>
			<?php echo $log['Log']['description']; ?>
		</td>
		<td>
			<?php echo $log['Log']['comment']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php
	echo $this->Js->writeBuffer();
?>

