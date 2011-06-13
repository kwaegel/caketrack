<div class="equipmentRecords index">
<h2>Showing results for: <? echo $searchString?></h2>
<ul>
<?php
if(isset($results))
{
	$i = 0;
	foreach ($results as $result)
	{
		// Alternate row colors
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		echo '<li', $class, '>';
			if(array_key_exists('Member', $result))
			{
				echo 'Member: ';
				echo $html->link($result['Member']['name'], array('controller' => 'members', 'action' => 'view', $result['Member']['id']));
			}
			else if (array_key_exists('EquipmentRecord', $result))
			{
				echo 'Equipment: ';
				$tracking->makeTrackingLink($result['EquipmentRecord']['id'], $result['Fund']['name'], $result['EquipmentRecord']['tracking_number']);
			}
		echo '</li>';

	}
}
else
{
	echo '<h3>No results found</h3>';
}
?>
</ul>
</div>