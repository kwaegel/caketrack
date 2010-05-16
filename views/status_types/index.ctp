<div class="statusTypes index">
<h2><?php echo 'Status types';?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('status_type');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($statusTypes as $statusType):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $statusType['StatusType']['id']; ?>
		</td>
		<td>
			<?php echo $statusType['StatusType']['status_type']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link('View', array('action' => 'view', $statusType['StatusType']['id'])); ?>
			<?php echo $html->link('Edit name', array('action' => 'edit', $statusType['StatusType']['id'])); ?>
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
		<li><?php echo $html->link('Add new status type', array('action' => 'add')); ?></li>
	</ul>
</div>
