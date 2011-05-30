<?php /* File: /app/views/search/index.ctp */?>
<div>
<h3>Testing</h3>
<?php
	// Open the form
	echo $form->create(false, array(
		'id'		=>'livesearch',
		'type'		=>'get',
		'default'	=>false
		)
	);
	
	// Create a text field
	echo $form->text('searchbox', array(
		'label'=>'Search:', 
		'type'=>'get', 
		'url'=>'/search/search',
		'id'=>'autocomplete'
		)
	);
	
	// Show loading icon
	echo '<div id="loading" style="display: none; ">' . $html->image("spinner.gif") . '</div>';
	
	// Close the form
	echo $form->end();
	
	// update results div while typing
	$js->get('#autocomplete');
	$js->event(
		'keyup',
		
		$js->request(
			'/search/autocomplete',
			array(	// options
				'method'=>'post',
				'async' => true,
				'update'=>'#view',
				'dataExpression'=>true,
				'data'=>$js->serializeForm(
					array(
						'isForm' => true, 
						'inline' => true
					)
				)
			)
		),
		array(
			'stop'=>false
		)
	);
?>

<div id="view" class="auto_complete">
    <!-- Results will load here -->
</div>
</div>