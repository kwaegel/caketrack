<?php /* File: /app/views/search/index.ctp */?>
<div>
<h3>Testing</h3>
<style>
	.ui-autocomplete-loading { background: white url('img/spinner.gif') right center no-repeat; }
</style>
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
?>
<script>
	$(function() {
		$( "#autocomplete" ).autocomplete({
			source: "search/autocomplete",
			minLength: 2
		});
	});
	</script>

<div id="view" class="auto_complete">
    <!-- Results will load here -->
</div>
</div>