<?php
namespace Rasty\actions;

use Rasty\exception\RastyException;
use Rasty\components\RastyPage;
use Rasty\i18n\Locale;

/**
 * Representa una acción a ejecutarse en rasty utilizando
 * la api RESTful.
 * 
 * @author bernardo
 * @since 22/04/2015
 */

abstract class RestfulAction{

	const STATUS_ERROR = 1;
	const STATUS_SUCCESS = 2;
	
	private $user;
	
	public function checkAuthentication(){

		/**
		 * TODO OAuth
		 */
		
		// Getting request headers
    	$headers = apache_request_headers();
    	$response = array();
	    // Verifying Authorization Header
	    if (isset($headers['Authorization'])) {
	    
	        // get the api key
	        $api_key = $headers['Authorization'];

	        // validating api key
	        if (!$this->isValidApiKey($api_key)) {
	            // api key is not present in users table
	            throw new \Exception('Invalid Api key');
	            
	        } else {
	            $this->user = $this->getUserByApikey($api_key);
	            if(empty($this->user))
	            	throw new \Exception('Invalid Api key');
	        }
	    } else {
	        // api key is missing in header
	         throw new \Exception('Api key is missing');
	    		        
            
	    }
 	}
 	

 	private function isValidApiKey( $apiKey ){
    	
    	return true;//$apiKey=="1";
    	
    }
    
    private function getUserByApikey( $apiKey ){
    	
    	$userService = \Cose\Security\service\ServiceFactory::getUserService();
    	
    	return $userService->get($apiKey);
    }
 	
		
	
	public function isSecure(){
		
		return true;
	}
	
	public function doPost(){
		
		throw new \Exception("Post Unsupported");
	}
	
	public function doGet(){
		
		throw new \Exception("Get Unsupported");
	}
	
	public function doPut(){
		
		throw new \Exception("Put Unsupported");
	}
	
	public function doDelete(){
		
		throw new \Exception("Delete Unsupported");
	}
	

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}
}

?>