<?php
/* /app/views/helpers/tracking.php */
class LoggingDisplayHelper extends AppHelper {

	var $helpers = array('Html', 'Tracking');
	
	function showLogs($relatedLogs, $paginator){
	
		echo '<div class="paging">';
			$paginator->options(array('update' => 'content', 'indicator' => 'spinner'));
			echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));
			echo $paginator->numbers();
			echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));
		echo '</div>
			<p>';
			echo $paginator->counter(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
		echo '</p>
			<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Created</th>
			<th>Updated by</th>
			<th>ID affected</th>
			<th>Member affected</th>
			<th>Description</th>
		</tr>';
		$i = 0;
		foreach ($relatedLogs as $log):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			
			echo '<tr', $class, '>';
				echo '<td>',$log['Log']['created'], '</td>';
				echo '<td>',
					$this->Html->link($log['User']['username'], array('controller' => 'users', 'action' => 'view', $log['Log']['user_id'])),
				'</td>';
				echo '<td>';
					if (isset($log['EquipmentRecord']['tracking_number']))
					{
						$this->Tracking->link($log['Log']['equipment_record_id'], $log['EquipmentRecord']['Fund']['name'], $log['EquipmentRecord']['tracking_number']);
					}
				echo '</td>
				<td>';
					if(isset($log['EquipmentRecord']['member_id']) || true)
					{
						echo $this->Html->link($log['Member']['name'], array('controller' => 'members', 'action' => 'view', $log['Log']['member_id']));
					}
				echo '</td>
				<td>', $log['Log']['description'], '</td>',
			'</tr>';
		endforeach;
		echo '</table>';
	}
}
?>
