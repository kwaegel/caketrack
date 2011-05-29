<?php /* File: /app/views/people/index.ctp */?>
<div>
<h3>Testing</h3>
<?php
	echo $form->create(false, array(
		'id'		=>'livesearch',
		'type'	=>'get',
		//'url'	=>'/search/search'
		//'default'	=>false
		)
	);
	
	echo $form->text('query', array(
		'label'=>'Search:', 
		'type'=>'get', 
		'url'=>'/search/search'
		)
	);
	
	echo '<div id="loading" style="display: none; ">' . $html->image("spinner.gif") . '</div>';
	
	echo $form->end();
	
	// update results div when typing
	$js->get('#query');
	
	$js->event(
		'keyup',
		$js->request(
			'/search/search',
			array(	// options
				'method'=>'get',
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