<?php
	//print_r($unassignedRecords);
?>

<div class="equipmentRecords index">
<h2>Equipment Availible to be Assigned</h2>
<p>(Does not include out of service or missing equipment.)</p>
<br />
<?php
$lastEquipmentType = '';
$printTableEnd = false;
$recordsCounted = 0;

$i = 0;
foreach ($unassignedRecords as $equipmentRecord):

	// Start new table if needed
	if ($equipmentRecord['EquipmentType']['type'] != $lastEquipmentType) {
		$lastEquipmentType = $equipmentRecord['EquipmentType']['type'];
		
		// Close any previous table
		if ($recordsCounted++ > 0) {
			echo '</table>';
		}
		
		echo '<h4>', $equipmentRecord['EquipmentType']['type'], '</h4>';
		?>
		<table cellpadding="0" cellspacing="0" class="unassignedEquipment">
		<tr>
			<th>Tracking Number</th>
			<th>Size</th>
			<th>Serial Number</th>
		</tr>
		<?php
	}

	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
				$tracking->makeTrackingLink($equipmentRecord['EquipmentRecord']['id'], $equipmentRecord['Fund']['name'], $equipmentRecord['EquipmentRecord']['tracking_number']);			
			?>
		</td>
				<td>
			<?php echo $equipmentRecord['EquipmentRecord']['size']; ?>
		</td>
		<td>
			<?php echo $equipmentRecord['EquipmentRecord']['serial_number']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>