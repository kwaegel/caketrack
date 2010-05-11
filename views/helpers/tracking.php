<?php
/* /app/views/helpers/tracking.php */
class TrackingHelper extends AppHelper {
	function makeTrackingLink($id, $fund, $trackingNumber) {
		if ($fund == 'general')
		{
			$linkText = 'GF ' . $trackingNumber;
		}
		else
		{
			$linkText = $trackingNumber;
		}
		
		echo '<a href="/cakeTrack/equipment_records/view/' . $id . '">' . $linkText . '</a>';
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
