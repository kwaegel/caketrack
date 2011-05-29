<?php
class SearchController extends AppController {

	var $uses = null;	// don't use a model
	var $components = array('RequestHandler');

	function index() {}
	
	function search($json = null) {
	
		if ($this->RequestHandler->isAjax())
		{
		
		
		}
		
		if (!empty($this->params['form']['query']))
		{
			$query = $this -> Sanitize -> paranoid($this->params['form']['query']);
			if (strlen($query) > 0)
			{
				// replace this with a query that searchs multable models
			    $result = $this -> Person -> findAll("name_first LIKE '%".$query."%' OR name_second LIKE '%".$query."%'");
			    $this->set('result', $result);
			    $this->layout = 'ajax';
			}
		}
		
		$this->set('result', $this);
		
		//$this->set('cakeDebug', $this->params);
	}

}