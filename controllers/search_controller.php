<?php
class SearchController extends AppController {

	var $uses = null;	// don't use a model
	var $components = array('RequestHandler');
	var $helpers = array('Tracking');
	var $paginate = array(
		'limit' => 20,
		'order' => array(
			'EquipmentRecord.tracking_number' => 'asc'
		)
	);

	function index() {}
	
	function results()
	{
		// Extract search terms
		$query = $this->data['searchbox'];
		$this->set('searchString', $query);
		
		if (strlen($query) > 0)
		{	
			$contains = array();
			
			// search the members model
			$memberSearchConditions = array("name LIKE"=>'%'.$query.'%');
			$memberResults = ClassRegistry::init('Member')-> find('all', array(
				'conditions'=>$memberSearchConditions,
				'limit'=>50
			));
			
			// Search the equipment list
			$fund = 'relief';
			if(stripos($query, 'gf') !== false)
			{
				// search general fund
				$fund = 'general';
				$query = ereg_replace("[^0-9]", "", $query );	// reduce to numbers
			}
			
			$equipmentSearchConditions = array(
				'and' => array(
					'Fund.name'=>$fund,
					"tracking_number LIKE"=>'%'.$query.'%'
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
			
			if (count($results) === 1)
			{	
				// redirect
				$result = $results[0];
				
				if(array_key_exists('Member', $result))
				{
					$controller = 'Members';
					$id = $result['Member']['id'];
				}
				else if (array_key_exists('EquipmentRecord', $result))
				{
					$controller = 'EquipmentRecords';
					$id = $result['EquipmentRecord']['id'];
				}
				$this->redirect(array('controller' => $controller, 'action' => 'view', $id));
			}
			else
			{
				$this->set('results', $results);
			}
		}
	}
	
	function autocomplete() {
		Configure::write('debug', '0');  //set debug to 0 for this function because debugging info breaks the XMLHttpRequest
		$this->header('Content-Type: application/json');
	
		if ($this->RequestHandler->isAjax())
		{	
			// Extract search terms
			$query = $_GET['term'];
			
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
				
				//Convert results into JSON format
				$i=0;
				foreach($memberResults as $result){
					$response[$i++]['label']=$result['Member']['name'];
				}
				foreach($equipmentResults as $result){
					if ($fund == 'general')
					{
						$response[$i++]['label']= 'GF '.$result['EquipmentRecord']['tracking_number'];	
					}
					else
					{
						$response[$i++]['label']=$result['EquipmentRecord']['tracking_number'];	
					}
				}
				//$this->set('response', $response);
				//echo json_encode($response);
				$this->set('results', $response);
				
				// Pass the search results to the view
				$results = array_merge($memberResults, $equipmentResults);
				//$this->set('results', $results);
				$this->set('entries', json_encode($results));
			}
		}
	}

}