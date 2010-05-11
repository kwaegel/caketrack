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
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('equipment_record_id');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
	<th class="actions"><?php __('Actions');?></th>
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
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $log['Log']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php $paginator->options(array('update' => 'content', 'indicator' => 'spinner')); ?>
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Log', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<?php $debug->dump($logs); ?>
