<?php
/* File: /app/views/people/autocomplete.ctp */
echo $js->object($results);

// if (isset($results)) {
	
	// if(is_array($results))
	// {
		// print '<ul class="ac-list">';
		// foreach ($results as $result)
		// {
			
			// if (isset($result['Member']))
			// {
				// $text = str_ireplace($query, '<span class="ac-typed">'.$query.'</span>', $result['Member']['name']);
				
				// echo '<li class="ac-item">';
				// echo $html->link($text, array('controller'=>'Members', 'action' => 'view', $result['Member']['id']), array('escape' => false));
				// echo '</li>';
			// }
			// else if(isset($result['EquipmentRecord']))
			// {
				// $text = str_ireplace($query, '<span class="ac-typed">'.$query.'</span>', $result['EquipmentRecord']['tracking_number']);
				// if ($result['Fund']['name'] == 'general')
				// {
					// $text = '<span class="ac-typed">GF </span>' . $text;
				// }
				
				// echo '<li class="ac-item">';
				// echo $html->link($text, array('controller'=>'EquipmentRecords', 'action' => 'view', $result['EquipmentRecord']['id']), array('escape' => false));
				// echo '</li>';
			// }
		// }
		// echo '</ul>';
	// }
	// $debug->dump($results);
// }

?>
