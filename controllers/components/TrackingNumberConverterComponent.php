<?php

class TrackingNumberConverterComponent extends Object {

	function TrackingNumberToPair($trackingNumber) {
	
		$haystack = strtolower($trackingNumber);
	
		$pos = strpos($trackingNumber, 'gf');
		
		if ($pos == false)
		{
			$fund = 'relief';
			$number = $trackingNumber;
		}
		else
		{
			$fund = 'general'
			$number = preg_replace(“/[^0-9\s]/”, “”, $trackingNumber);
		}

		return array('fund'=>$fund, 'number'=>$number);
	}
}

?>
