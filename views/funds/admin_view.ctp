<div class="funds view">
<h2><?php  __('Fund');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fund['Fund']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fund['Fund']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Fund', true), array('action' => 'edit', $fund['Fund']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Fund', true), array('action' => 'delete', $fund['Fund']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fund['Fund']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Funds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Fund', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
