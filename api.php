<?php
require_once 'class.php';
class MyApi extends API
{
	protected $User;
	
	public function __construct($request, $origin) {
	 parent::__construct($request);
	 
	 //Abstracted out for example
	 $APIKey = 123;
	 $User = "nick";
	 
	/* if (!array_key_exists('apiKey', $this->request)) {
		throw new Exception('No API Key Provided');
	 } else if ($this->request['apiKey'] != "123") {
		throw new Exception('Invalid API Key');	
	 }
	 /*else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
		throw new Exception('Invalid API Key');		
	 } /*else if (array_key_exists('token', $this->request) && !$User->get('token', $this->request['token'])) {
		throw new Exception('Invalid User Token');
	 }
	 */
	 $this->User = $User;
	}
	
	/**
	* Endpoint for getting a random historical quote
	*/
	
	protected function randomHistorical() {
		if($this->method == 'GET') {
			$pdo = new PDO('sqlite:quotesdb.sqlite3');
			$sql = "SELECT quote, author FROM quotetable WHERE category_id = 1 ORDER BY RANDOM() LIMIT 1;";
			$results = $pdo->query($sql)->fetch();			
			unset($results[0]);
			unset($results[1]);
			return $results;					
		} else {
			return "Only Accepts GET requests";
		}
	}	
	
	/* Endpoint for getting an insult
	*
	*/
	protected function randomInsult() {
		if($this->method == 'GET') {
			$pdo = new PDO('sqlite:quotesdb.sqlite3');
			$sql = "SELECT quote, author FROM quotetable WHERE category_id = 3 ORDER BY RANDOM() LIMIT 1;";
			$results = $pdo->query($sql)->fetch();			
			unset($results[0]);
			unset($results[1]);
			return $results;					
		} else {
			return "Only Accepts GET requests";
		}
	}	
	
	/* Endpoint for getting an inspirational quote
	*
	*/
	protected function randomInspirational() {
		if($this->method == 'GET') {
			$pdo = new PDO('sqlite:quotesdb.sqlite3');
			$sql = "SELECT quote, author FROM quotetable WHERE category_id = 2 ORDER BY RANDOM() LIMIT 1;";
			$results = $pdo->query($sql)->fetch();			
			unset($results[0]);
			unset($results[1]);
			return $results;					
		} else {
			return "Only Accepts GET requests";
		}
	}	

}

//requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
	$_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
	$API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
	echo $API->processAPI();	
} catch (Exception $e) {
	echo json_encode(Array('error' => $e->getMessage()));
}

?>