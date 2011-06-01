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
	
	// // update results div while typing
	// $js->get('#autocomplete');
	// $js->event(
		// 'keyup',
		
		// $js->request(
			// '/search/autocomplete',
			// array(	// options
				// 'method'=>'post',
				// 'async' => true,
				// 'update'=>'#view',
				// 'dataExpression'=>true,
				// 'data'=>$js->serializeForm(
					// array(
						// 'isForm' => true, 
						// 'inline' => true
					// )
				// )
			// )
		// ),
		// array(
			// 'stop'=>false
		// )
	// );
?>
<script>
	$(function() {
		
		// $( "#tags" ).autocomplete({
			// source: function( request, response ) {
				// $.ajax({
					// url: "http://ws.geonames.org/searchJSON",
					// dataType: "jsonp",
					// data: {
						// featureClass: "P",
						// style: "full",
						// maxRows: 12,
						// name_startsWith: request.term
					// },
					// success: function( data ) {
						// response( $.map( data.geonames, function( item ) {
							// return {
								// label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								// value: item.name
							// }
						// }));
					// }
				// });
			// },
			// minLength: 2
		// });
		
		//$( "#tags" ).autocomplete({
			//source: "search/test",
			//source:  ["c++", "java", "php", "coldfusion", "javascript", "asp", "ruby"]
			// source: function( request, response ) {
				// $.ajax({
					// url: "search/test",
					// dataType: "json",
					// data: {
						// term: request.term
					// }
					// ,
					// success: function( data )
                    // {
						// response(data);
                        // // response( $.map( data, function( item )
                        // // {
                            // // return{
                                    // // label: item.name,
                                    // // value: item.value,
                                    // // id: item.id
                                   // // }
                        // // }));
                    // }
					// // success: function( data ) {
						// // response( $.map( data.geonames, function( item ) {
							// // return {
								// // label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								// // value: item.name
							// // }
						// // }));
					// // }
				// });
			// }
		//});
		
		$( "#tags" ).autocomplete({
			source: "search/test"
		});
		
		$( "#autocomplete" ).autocomplete({
			source: "search/autocomplete",
			minLength: 2
		});
	});
	</script>
	
<div class="demo">

<div class="ui-widget">
	<label for="tags">Tags: </label>
	<input id="tags">
</div>

</div>
<!-- End demo -->



<div style="display: none;" class="demo-description">
<p>The Autocomplete widgets provides suggestions while you type into the field. Here the suggestions are tags for programming languages, give "ja" (for Java or JavaScript) a try.</p>
<p>The datasource is a simple JavaScript array, provided to the widget using the source-option.</p>
</div><!-- End demo-description -->

<div id="view" class="auto_complete">
    <!-- Results will load here -->
</div>
</div>