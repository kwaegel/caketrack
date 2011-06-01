<?php
header('Content-type: application/json');
header('X-JSON: ' . $js->object($response));
Configure::write('debug', 0);
//echo $javascript->object($tags);
?>