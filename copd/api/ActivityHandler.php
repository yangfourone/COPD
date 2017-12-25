<?php
//---------------------------------------------------------------------------------ActivityHandler
require_once('connect.php');
require_once('SimpleRest.php');
require_once('Activity.php');
class ActivityHandler extends SimpleRest{
	public $method, $action, $id, $input;
	//constructor
	public function __construct($method,$params,$input){
		$this->method = strtolower($method);
		$this->action = strtolower($params[1]);
		if(isset($params[2]))
			$this->id = strtolower($params[2]);
		if(isset($input))
			$this->input = $input;
		
	}
	function response(){
		//parsing method 
		switch($this->method){
			case 'get':
				if($this->action == 'getall'){
					$activity_all = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_all->getAll());
					break;
				}
				else if($this->action == 'getbytime'){
					$activity_time = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_time->getByTime($this->id));
					break;
				}
				else if($this->action == 'getbyid'){
					$activity_id = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_id->getById($this->id));
					break;
				}
			case 'post':
				if($this->action == 'add'){
					$activity_add = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_add->add($this->input));
					break;
				}
				else if($this->action == 'update'){
					$activity_update = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_update->updatebyid($this->input));
					break;
				}
			case 'delete':
				if($this->action == 'delete'){
					$activity_delete = new Activity();
					$this ->setHttpHeaders('application/json', 200);
					echo $this->encodeJson($activity_delete->delete($this->id));
					break;
				}
			default:
				$this ->setHttpHeaders('application/json', 404);
				echo 'METHOD Error!';
		}
	}
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// 创建 SimpleXMLElement 对象
		$xml = new SimpleXMLElement('<?xml version="1.0"?><site></site>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
}

?>