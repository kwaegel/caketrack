<div class="equipmentTypes index">
<h2><?php echo 'Equipment Types';?></h2>
<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>
</p>
<div class="paging">
	<?php echo $paginator->prev('<< '.'previous', array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next('next'.' >>', array(), null, array('class' => 'disabled'));?>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('type');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($equipmentTypes as $equipmentType):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<!--<td>
			<?php echo $equipmentType['EquipmentType']['id']; ?>
		</td>-->
		<td>
			<?php echo $equipmentType['EquipmentType']['type']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link('View',	array('action' => 'view', $equipmentType['EquipmentType']['id'])); ?>
			<?php echo $html->link('Edit Name',	array('action' => 'edit', $equipmentType['EquipmentType']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Add new equipment type', array('action' => 'add')); ?></li>
	</ul>
</div>
