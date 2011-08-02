<div class="users index">
<h2><?php __('Users');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'));
?></p>
<div class="paging">
	<?php echo $paginator->prev('<< previous', array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next('next >>', array(), null, array('class' => 'disabled'));?>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('username');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('admin');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['id']; ?>
		</td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['created']; ?>
		</td>
		<td>
			<?php echo $user['User']['modified']; ?>
		</td>
		<td>
			<?php echo $user['User']['admin']; ?>
		</td>
		<td class="actions">
			<?php
				echo $html->link('View', array('action' => 'view', $user['User']['id'])); 
				echo $html->link('Edit', array('action' => 'edit', $user['User']['id']));
			?>
			
			<!--<?php //echo $html->link('Delete', array('action' => 'delete', $user['User']['id']), null, sprintf('Are you sure you want to delete # %s?', $user['User']['id'])); ?>-->
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
	<?php
	if($userAuth['User']['admin'] == 1) {
		echo '<li>', $html->link('Add New User', array('action' => 'register')), '</li>';
	}
	?>
	</ul>
</div>
