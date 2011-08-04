<?php
/* /app/views/helpers/tracking.php */
class TrackingHelper extends AppHelper {

	var $helpers = array('Html');
	
	function link($id, $fund, $trackingNumber) {
	
		$linkText = ($fund == 'general') ? 'GF ' . $trackingNumber : $trackingNumber;
		
		echo $this->Html->link($linkText, array('controller' => 'equipment_records', 'action' => 'view', $id));
	}
	
	function makeTrackingLink($id, $fund, $trackingNumber) {
		$this->link($id, $fund, $trackingNumber);
	}
	
	function makeTrackingString($fund, $trackingNumber) {
		if ($fund == 'general')
		{
			echo 'GF ' . $trackingNumber;
		}
		else
		{
			echo $trackingNumber;
		}
	}
}
?>
