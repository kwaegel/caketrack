<?php
/* File: /app/views/people/search.ctp */
echo "results:";
if (isset($result)) {

	$debug->dump($result);
	/*
	print '<ul>';
	foreach ($result as $user)
	{
	    $display = $user['Person']['name_first'] . ' ' . $user['Person']['name_second'];
	    print '<li>';
		   print '' . $display . '';
	    print '';
	}
	print '</ul>';
	*/
}

?>
