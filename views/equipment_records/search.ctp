<?php
	// ensure arguments are passed through urls correctly
	//$paginator->options(array('url' => $this->passedArgs));
?>
<div class="equipmentRecords search">
<h2><?php __('Equipment Records search');?></h2>

<div class="ActionForm">
	<?php echo $form->create('EquipmentRecord', array('action' => 'search', 'type'=>'get'));?>
	<?php echo $form->input('tracking_number', array('label'=>'Input tracking number:')); ?>
	<?php echo $form->end('Search');?>
</div>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link('Add new equipment record', array('action' => 'add')); ?></li>
	</ul>
</div>