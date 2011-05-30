<?php
class SearchController extends AppController {

	var $uses = null;	// don't use a model
	var $components = array('RequestHandler');

	function index() {}
	
	function autocomplete($json = null) {
	
		if ($this->RequestHandler->isAjax())
		{	
			// Extract search terms
			$query = $this->params['form']['searchbox'];
			$this->set('query', $query);
			
			if (strlen($query) > 0)
			{	
				$contains = array();
				
				// search the members model
				$memberSearchConditions = array("name LIKE"=>'%'.$query.'%');
			    $memberResults = ClassRegistry::init('Member')-> find('all', array(
					'conditions'=>$memberSearchConditions,
					'limit'=>5
				));
				
				// Search the equipment list
				$fund = 'relief';
				if(stripos($query, 'gf') !== false)
				{
					// search general fund
					$fund = 'general';
					//$query = str_ireplace('gf', '', $query);
					$query = ereg_replace("[^0-9]", "", $query );	// reduce to numbers
				}
				
				$equipmentSearchConditions = array(
					'and' => array(
						'Fund.name'=>$fund,
						"tracking_number LIKE"=>$query.'%'
					)
				);
				$equipmentContain=array('Fund.name');
			    $equipmentResults = ClassRegistry::init('EquipmentRecord')-> find('all', array(
					'conditions'=>$equipmentSearchConditions,
					'contain'=>$equipmentContain,
					'fields'=>array('id', 'tracking_number'),
					'limit'=>5
					)
				);
				
				// Pass the search results to the view
				$results = array_merge($memberResults, $equipmentResults);
				if(count($results) > 0)
				{
					$this->set('results', $results);
				}
				else
				{
					$this->set('results', 'No results found');
				}
			    $this->layout = 'ajax';
			}
		}
		else
		{
			$this->set('result', 'No search term entered');
		}
		
		//$this->set('cakeDebug', $this->params);
	}

}