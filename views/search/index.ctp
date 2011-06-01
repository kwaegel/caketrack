<?php /* File: /app/views/search/index.ctp */?>
<div>
<h3>Testing</h3>
<style>
	.ui-autocomplete-loading { background: white url('img/spinner.gif') right center no-repeat; }
</style>
<?php
	// Open the form
	echo $form->create(false, array('action'=>'search', 'id'=>'search'));
	
	// Create a text field
	echo $form->text('searchbox', array(
		'label'=>'Search:', 
		'type'=>'get', 
		'url'=>'/search/search',
		'id'=>'autocomplete'
		)
	);
	
	echo $this->Form->submit("->");
	
	// Show loading icon
	echo '<div id="loading" style="display: none; ">' . $html->image("spinner.gif") . '</div>';
	
	// Close the form
	echo $form->end();
?>
<script>
	$(function() {
		$( "#autocomplete" ).autocomplete({
			source: "search/autocomplete",
			minLength: 2,
			// The select function submits the form if enter is pressed on one of the menu items
			select: function(event, ui) {
				if(ui.item){
					$("#autocomplete").val(ui.item.value);
					$('#search').submit();
				}
			}
		});
	});
	</script>

<div id="view" class="auto_complete">
    <!-- Results will load here -->
</div>
</div>